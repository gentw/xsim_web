<?php

namespace App\Http\Controllers;

use App\Mail\AdminCardPurchase;
use App\Mail\AdminCardReload;
use App\Mail\AdminGroupReload;
use App\Mail\CardPurchase;
use App\Mail\CardReload;
use App\Mail\ContactMail;
use App\Mail\GroupReload;
use App\Models\Buy_card;
use App\Models\Card;
use App\Models\GroupReloadData;
use App\Models\Payment_transaction;
use App\Models\Reload_data;
use App\Models\Usedcoupon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDF;

class ActionController extends CardApiController
{
    public function buy_card($qty_reg = 0, $qty_32 = 0, $qty_50 = 0, $user_id = 7960, $payment_id = NULL,$coupon_id = NULL)
    {
        $transaction = Payment_transaction::where('transation_id', $payment_id)->first();
        if(!empty($transaction)){
            $user = User::find($user_id);
            $data = ['user_id' => $user_id, 'qty_regular' => $qty_reg, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'transaction_id' => $payment_id, 'payment_transaction_id' => $transaction->id,'coupon_id' => $coupon_id];
            $card = Buy_card::create($data);
            $card->order_number = date('Y') . '/' . date('m') . '/' . $card->id;
            $card->save();
            $pdf = PDF::loadView('pages/format', ['transaction_id' => $payment_id, 'item' => "Standard XXSIM without credit - &euro; 12", 'qty' => $qty_reg, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'price' => 12, 'total_amount' => $transaction->amount, 'address' => $user->contact->address, 'city' => $user->contact->city, 'state' => $user->contact->state, 'zip' => $user->contact->zip, 'country' => (!empty($user->contact->country) ? $user->contact->country->name : '') ]);
            $pdf->save(public_path('files/invoice.pdf'));
            Mail::to($user->username)->send(new CardPurchase(['name' => $user->contact->firstname, 'order_id' => $card->order_number]));
            Mail::to('info@xxsim.com')->send(new AdminCardPurchase(['name' => $user->contact->firstname, 'qty_regular' => $qty_reg, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'order_number' => $card->order_number, 'transation_id' => $payment_id, 'amount' => $transaction->amount, 'address' => $user->contact->address, 'city' => (!empty($user->contact->city) ? $user->contact->city : 'N/A'), 'country' => (!empty($user->contact->country) ? $user->contact->country->name : 'N/A'), 'zip' => (!empty($user->contact->zip) ? $user->contact->zip : 'N/A') ]));
            return $card;
        }
        else{
            return [];
        }
    }

    public function buy_regular_card(Request $request){
       

        $user_id=Auth::id();
        $user = User::find($user_id);
        $data = ['user_id' => $user_id, 'qty_regular' => 1, 'qty_32' => 0, 'qty_50' => 0, 'transaction_id' =>NULL, 'payment_transaction_id' => NULL,'coupon_id' => $request->coupon_id];
        $card = Buy_card::create($data);
        $card->order_number = date('Y') . '/' . date('m') . '/' . $card->id;
        $card->save();

        $pdf = PDF::loadView('pages/format', ['transaction_id' => 'N/A', 'item' => "Standard XXSIM without credit - &euro; 12", 'qty' => 1, 'qty_32' => 0, 'qty_50' => 0, 'price' => 0, 'total_amount' => 0, 'address' => $user->contact->address, 'city' => $user->contact->city, 'state' => $user->contact->state, 'zip' => $user->contact->zip, 'country' => (!empty($user->contact->country) ? $user->contact->country->name : '') ]);
        $pdf->save(public_path('files/invoice.pdf'));

        Mail::to('info@xxsim.com')->send(new AdminCardPurchase(['name' => $user->contact->firstname, 'qty_regular' => 1, 'qty_32' =>0, 'qty_50' => 0, 'order_number' => $card->order_number, 'transation_id' => 'N/A', 'amount' => 0, 'address' => $user->contact->address, 'city' => (!empty($user->contact->city) ? $user->contact->city : 'N/A'), 'country' => (!empty($user->contact->country) ? $user->contact->country->name : 'N/A'), 'zip' => (!empty($user->contact->zip) ? $user->contact->zip : 'N/A') ]));

        Mail::to($user->username)->send(new CardPurchase(['name' => $user->contact->firstname, 'order_id' => $card->order_number]));
        flash('Your order is considered, Our team member will contact you.')->success();

        $usedcoupon = new Usedcoupon;
        $usedcoupon->user_id=Auth::id();
        $usedcoupon->coupon_id=$request->coupon_id;
        $usedcoupon->save();

        return redirect()->route('online_shop');
    }

    public function ajax_buy_card(Request $request)
    {
    	$content  = ['status' => 204, 'message' => "something went wrong"];
    	$qty_reg = (!empty($request->qty_regular) ? $request->qty_regular : 0);
    	$qty_micro = (!empty($request->qty_micro) ? $request->qty_micro : 0);
        $qty_nano = (!empty($request->qty_nano) ? $request->qty_nano : 0);
    	$payment_id = (!empty($request->payment_id) ? $request->payment_id : NULL);
    	$card = $this->buy_card($qty_reg, $qty_micro, $qty_nano, $payment_id);
    	if(!empty($card)){
    		$content['status'] = 200;
    		$content['message'] = "Suceess";
    	}
    	return response()->json($content);
    }

    public function add_card_reload_data(Request $request)
    {
        $transaction = Payment_transaction::where('transation_id', $request->payment_id)->first();
        if(!empty($transaction)){
            if(!empty($request->card_reload) && $request->card_reload == 'y'){
                Reload_data::create(['number' => $request->number, 'amount' => $request->amount, 'validity' => date('Y-m-d', strtotime("+1 year")), 'transaction_id' => $request->payment_id, 'payment_transaction_id' => $transaction->id]);
            }
            else{
                $transaction->status = "need_to_refund";
                $transaction->save();
            }
        }
    }

    public function reload_card(Request $request, $number = '37281720314', $amount = 01, $payment_id = NULL)
    {
        $orderLog = new Logger('order');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/check.log')), Logger::INFO);
        $orderLog->info('SMSLimitLog_1', ['number' => $number, 'amount' => $amount, 'payment_id' => $payment_id]);
        $transaction = Payment_transaction::where('transation_id', $payment_id)->first();
        if(!empty($number)){
            $data = ['api_name'=> 'account_details'];

            $response = $this->card_api($request, $data);

            $orderLog = new Logger('order');
            $orderLog->pushHandler(new StreamHandler(storage_path('logs/check.log')), Logger::INFO);
            $orderLog->info('SMSLimitLog_2', ['response' => $response]);

            if($response['status'] == 200){
                $result = json_decode($response['result']);
                $data = ['api_name'=> 'reload', 'card'=> $number, 'amount'=> $amount, 'orderid'=> ($result->orderid+1)];
                $response = $this->card_api($request, $data);

                if($response['status'] == 200){
                    $reload_data = Reload_data::create(['number' => $number, 'amount' => $amount, 'validity' => date('Y-m-d', strtotime("+1 year")), 'transaction_id' => $payment_id, 'payment_transaction_id' => $transaction->id]);

                    $card = Card::where(['card_number' => $number, 'active' => 1])->first();

                    if(!empty($card)){
                        $pdf = PDF::loadView('pages/format', ['transaction_id' => $payment_id, 'item' => "Reload a card", 'qty' => 1, 'price' => $amount, 'total_amount' => $amount, 'address' => $card->user->contact->address, 'city' => $card->user->contact->city, 'state' => $card->user->contact->state, 'zip' => $card->user->contact->zip, 'country' => (!empty($card->user->contact->country) ? $card->user->contact->country->name : '')]);
                        $pdf->save(public_path('files/invoice.pdf'));
                        Mail::to($card->user->username)->send(new CardReload(['name' => $card->user->contact->firstname, 'card' => $number, 'amount' => $amount, 'date' => $reload_data->validity]));
                        Mail::to('info@xxsim.com')->send(new AdminCardReload(['name' => $card->user->contact->firstname, 'card' => $number, 'amount' => $amount, 'transation_id' => $payment_id]));
                    }

                    Card::where('card_number', $number)->update(['card_validity' => date('Y-m-d', strtotime("+1 year"))]);
                }
                else{
                    $transaction->status = "need_to_refund";
                    $transaction->save();
                }
            }
            else{
                $transaction->status = "need_to_refund";
                $transaction->save();
            }
        }

        return true;
    }

    public function contact_mail(Request $request)
    {
        $content  = ['status' => 204, 'message' => "The email address field is required"];
        if(!empty($request->email)){
            Mail::to('info@xxsim.com')->send(new ContactMail(['value' => $request->email, 'type' => 'email']));
            $content['status'] = 200;
            $content['message'] = "XXSIM will contact you soon via this email address.";
        }
        return response()->json($content);
    }

    public function contact_phone(Request $request)
    {
        $content  = ['status' => 204, 'message' => "The phone number field is required"];
        if(!empty($request->phone)){
            Mail::to('info@xxsim.com')->send(new ContactMail(['value' => $request->phone, 'type' => 'phone']));
            $content['status'] = 200;
            $content['message'] = "XXSIM will contact you soon via this phone number.";
        }
        return response()->json($content);
    }

    public function reload_group(Request $request, $group_id = 0, $amount = 01, $payment_id = NULL, $group_name = NULL, $user_id = NULL)
    {
        $transaction = Payment_transaction::where('transation_id', $payment_id)->first();
        if(!empty($group_id)){
            $data = ['api_name'=> 'account_details'];

            $response = $this->card_api($request, $data);

            if($response['status'] == 200){
                $result = json_decode($response['result']);
                $data = ['api_name'=> 'reload_group', 'group_id'=> $group_id, 'amount'=> $amount, 'orderid'=> ($result->orderid+1)];
                $response = $this->card_api($request, $data);

                if($response['status'] == 200){
                    GroupReloadData::create(['user_id' => $user_id, 'payment_transaction_id' => $transaction->id, 'group_id' => $group_id, 'group_name' => $group_name, 'amount' => $amount, 'transaction_id' => $payment_id]);
                    $user = User::find($user_id);
                    $pdf = PDF::loadView('pages/format', ['transaction_id' => $payment_id, 'item' => "Reload a group", 'qty' => 1, 'price' => $amount, 'total_amount' => $amount, 'address' => $user->contact->address, 'city' => $user->contact->city, 'state' => $user->contact->state, 'zip' => $user->contact->zip, 'country' => (!empty($user->contact->country) ? $user->contact->country->name : '')]);
                    $pdf->save(public_path('files/invoice.pdf'));
                    Mail::to($user->username)->send(new GroupReload(['name' => $user->contact->firstname, 'group_name' => $group_name, 'amount' => $amount]));
                    Mail::to('info@xxsim.com')->send(new AdminGroupReload(['name' => $user->contact->firstname, 'group_id' => $group_id, 'group_name' => $group_name, 'amount' => $amount, 'transation_id' => $payment_id,]));
                }
                else{
                    $transaction->status = "need_to_refund";
                    $transaction->save();
                }
            }
            else{
                $transaction->status = "need_to_refund";
                $transaction->save();
            }
        }

        return true;
    }

    /*public function reload_check_card(Request $request, $number = '37281720314', $amount = 01, $payment_id = NULL)
    {
        $transaction = Payment_transaction::where('transation_id', $payment_id)->first();
        if(!empty($number)){
            $card = Card::where(['card_number' => $number, 'active' => 1])->first();
            if(!empty($card)){
                Mail::to('info@xxsim.com')->send(new AdminCardReload(['name' => $card->user->contact->firstname, 'card' => $number, 'amount' => $amount, 'transation_id' => $payment_id]));
                Mail::to('chirag.p@yudiz.in')->send(new CardReload(['name' => $card->user->contact->firstname, 'card' => $number, 'amount' => $amount, 'date' => '2019-07-11']));
            }
        }
        return true;
    }*/
}
