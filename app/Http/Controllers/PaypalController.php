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

class PaypalController extends ActionController
{
    /*
    * Process payment with express checkout
    */
    public function make_payment(Request $request)
    {
        $content  = ['status' => 204, 'message' => "something went wrong"];
        $total_amount = 0;
        $description = "Charge for ";
        
        if(!empty($request->qty_regular) || !empty($request->qty_32) || !empty($request->qty_50)){
            $total_amount += ($request->qty_regular * 12) + ($request->qty_32 * 32) + ($request->qty_50 * 50);
            $description .= 'buy card';
        }
        elseif(!empty($request->reload_amount) && !empty($request->reload_number)){
            $total_amount += $request->reload_amount;
            $description .= 'reload a card number ' . $request->reload_number;
        }
        elseif(!empty($request->relaod_group_amount) && !empty($request->group_id) && !empty($request->group_name)){
            $total_amount += $request->relaod_group_amount;
            $description .= 'reload a group id ' . $request->group_id . ' and name of group is ' . $request->group_name;
        }
        else{
            flash('Something went wrong! Please try again later.')->error();
            return redirect()->back();
        }

        $qty_regular = !empty($request->qty_regular) ? $request->qty_regular : 0;
        $qty_32 = !empty($request->qty_32) ? $request->qty_32 : 0;
        $qty_50 = !empty($request->qty_50) ? $request->qty_50 : 0;
        $reload_amount = !empty($request->reload_amount) ? $request->reload_amount : 0;
        $reload_number = !empty($request->reload_number) ? $request->reload_number : '';
        $group_name = !empty($request->group_name) ? $request->group_name : '';
        $group_id = !empty($request->group_id) ? $request->group_id : '';
        $relaod_group_amount = !empty($request->relaod_group_amount) ? $request->relaod_group_amount : 0;
        $user_id = !empty(Auth::id()) ? Auth::id() : '';
        $discount_amount = !empty($request->discount_amount) ? $request->discount_amount : 0;
        $coupon_id = !empty($request->coupon_id) ? $request->coupon_id : 0;


        if(!empty($qty_regular) || !empty($qty_32) || !empty($qty_50)){
            $item = ['type' => 'buy', 'qty_reg'=> $qty_regular, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'name' => 'Buy Card', 'user_id' => $user_id,'coupon_id'=>$coupon_id,'discount_amount'=>$discount_amount];
        }
        if(!empty($reload_amount)){
            $item = ['type' => 'reload', 'number'=> $reload_number, 'amount' => $reload_amount, 'name' => 'Reload a card', 'user_id' => $user_id];
        }
        if(!empty($relaod_group_amount)){
            $item = ['type' => 'reload_group', 'group_id' => $group_id, 'group_name' => $group_name, 'amount' => $relaod_group_amount, 'name' => 'Reload a group', 'user_id' => $user_id];
        }

        if(!empty($item)){
            $item_data = Temp_payment_data::create(['data' => serialize($item)]);

            $content['data'] = ['item_name' => $item['name'], 'item_price' => $total_amount, 'item_id' => $item_data->id, 'item_type' => $item['type'],'discount_amount'=>$discount_amount];
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
            return redirect()->route('dashboard.auto_reload', 'advance');
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
            return redirect()->route('dashboard.auto_reload', 'advance');
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
                    $coupon_id=$data['coupon_id'] ?? null;
                    $this->buy_card($data['qty_reg'], $data['qty_32'], $data['qty_50'], $data['user_id'], $transaction->transation_id,$coupon_id);
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
