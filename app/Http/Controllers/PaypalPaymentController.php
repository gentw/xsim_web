<?php

namespace App\Http\Controllers;

use App\Mail\AbandonedCart;
use App\Mail\CardReload;
use App\Models\Payment_transaction;
use App\Models\Temp_payment_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PayPal\Exception\PayPalConnectionException;
use Paypalpayment;

class PaypalPaymentController extends ActionController
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->content  = ['status' => 204, 'message' => "something went wrong"];
    }

    /*
    * Process payment with express checkout
    */
    public function paywithPaypal(Request $request)
    {
        $content = ['status' => 412, 'message'=> 'something went wrong', 'data'=>NULL];
        $total_amount = 0;

        if(!empty($request->qty_regular)){
            $total_amount += ($request->qty_regular * 12);
        }

        if(!empty($request->qty_micro)){
            $total_amount += ($request->qty_micro * 12);
        }

        if(!empty($request->qty_nano)){
            $total_amount += ($request->qty_nano * 12);
        }

        if(!empty($request->relaod_amount)){
            $total_amount += $request->relaod_amount;
        }

        if(!empty($request->relaod_group_amount)){
            $total_amount += $request->relaod_group_amount;
        }

        $qty_regular = !empty($request->qty_regular) ? $request->qty_regular : 0;
        $qty_micro = !empty($request->qty_micro) ? $request->qty_micro : 0;
        $qty_nano = !empty($request->qty_nano) ? $request->qty_nano : 0;
        $relaod_amount = !empty($request->relaod_amount) ? $request->relaod_amount : 0;
        $relaod_group_amount = !empty($request->relaod_group_amount) ? $request->relaod_group_amount : 0;
        $user_id = !empty(Auth::id()) ? Auth::id() : '';

        if(!empty($qty_regular) || !empty($qty_micro) || !empty($qty_nano)){
            $item = ['type' => 'buy', 'qty_reg'=> $qty_regular, 'qty_micro' => $qty_micro, 'qty_nano' => $qty_nano, 'name' => 'Buy Card', 'user_id' => $user_id];
        }

        if(!empty($relaod_amount)){
            $item = ['type' => 'reload', 'number'=> $request->reload_number, 'amount' => $request->relaod_amount, 'name' => 'Reload a card', 'user_id' => $user_id];
        }

        if(!empty($relaod_group_amount)){
            $item = ['type' => 'reload_group', 'group_id' => $request->group_id, 'group_name' => $request->group_name, 'amount' => $request->relaod_group_amount, 'name' => 'Reload a group', 'user_id' => $user_id];
        }

        if(!empty($item)){
            $item_data = Temp_payment_data::create(['data' => serialize($item)]);
            $content['data'] = ['item_name' => $item['name'], 'item_price' => $total_amount, 'item_id' => $item_data->id, 'item_type' => $item['type']];
            $content['status'] = 200;
            $content['message'] = "success";
        }

        return response()->json($content, 200);
    }

    public function payment_success(Request $request)
    {
        $data = explode('&', $request->custom);
        $orderLog = new Logger('order');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/sms.log')), Logger::INFO);
        $orderLog->info('SMSLimitLog', $_POST);
        flash('Your order is in processing.')->success();

        if($data[0] == 'reload_group'){
            return redirect()->route('dashboard.auto_reload');
        }
        else{
            return redirect()->route('online_shop');
        }
    }

    public function payment_error(Request $request)
    {
        $data = explode('&', $request->custom);
    	flash('Your payment has been failed.')->error();
        if(!empty(Auth::id())){
            Mail::to(Auth::user()->username)->send(new AbandonedCart(['name' => Auth::user()->contact->firstname]));    
        }
    	if($data[0] == 'reload_group'){
            return redirect()->route('dashboard.auto_reload');
        }
        else{
            return redirect()->route('online_shop');
        }
    }

    public function payment_notify(Request $request)
    {
        $orderLog = new Logger('order');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/ipn.log')), Logger::INFO);
        $orderLog->info('SMSLimitLog', $_POST);
        if($request->payment_status == "Completed"){
            $status = 'success';
        }
        else{
            $status = 'failed';
        }

        $check_transaction = Payment_transaction::where('transation_id', $request->txn_id)->first();

        if(empty($check_transaction)){
            $transaction = Payment_transaction::create(['type' => 'paypal', 'transation_id' => $request->txn_id, 'amount' => $request->mc_gross, 'response' => json_encode($request->all()), 'status' => $status, 'paypal_payer_id' => $request->payer_id ]);
            $custom_data = explode('&', $request->custom);

            $orderLog = new Logger('order');
	        $orderLog->pushHandler(new StreamHandler(storage_path('logs/check.log')), Logger::INFO);
	        $orderLog->info('SMSLimitLog_3', ['txn_id' => $transaction->transation_id, 'status' => $transaction->status, 'custom_data' => $custom_data]);

            if($transaction->status == 'success'){
                $payment_data = Temp_payment_data::where('id', $custom_data[1])->first();
                $data = unserialize($payment_data->data);

                $orderLog = new Logger('order');
		        $orderLog->pushHandler(new StreamHandler(storage_path('logs/check.log')), Logger::INFO);
		        $orderLog->info('SMSLimitLog_4', ['data' => $data, 'txn_id' => $transaction->transation_id, 'custom_data' => $custom_data[1]]);

                if($data['type'] == 'reload'){
                	$orderLog = new Logger('order');
			        $orderLog->pushHandler(new StreamHandler(storage_path('logs/check.log')), Logger::INFO);
			        $orderLog->info('SMSLimitLog_5', ['data' => $data, 'txn_id' => $transaction->transation_id]);
                    $this->reload_card($request, $data['number'], $data['amount'], $transaction->transation_id);
                }
                else if($data['type'] == 'reload_group'){
                	$group_name = !empty($data['group_name']) ? $data['group_name'] : NULL;
                	$user_id = !empty($data['user_id']) ? $data['user_id'] : NULL;
                    $this->reload_group($request, $data['group_id'], $data['amount'], $transaction->transation_id, $group_name, $user_id);
                }
                else if($data['type'] == 'buy'){
                    $this->buy_card($data['qty_reg'], $data['qty_micro'], $data['qty_nano'], $data['user_id'], $transaction->transation_id);
                }
            }
        }
    }

    /*public function paypal_check(Request $request)
    {
        $transaction = Payment_transaction::where(['transation_id' => '67P72588SP072073T'])->first();
        $payment_data = Temp_payment_data::where('id', 297)->first();
        $data = unserialize($payment_data->data);
        $this->reload_check_card($request, $data['number'], $data['amount'], $transaction->transation_id);
    }*/
}
