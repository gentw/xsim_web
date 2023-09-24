<?php

namespace App\Http\Controllers;

use App\Models\Payment_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class StripeController extends ActionController
{
    public function make_payment(Request $request)
    {
    	$total_amount = 0;
    	$coupon_id=0;
    	$description = "Charge for ";
    	
        if(!empty($request->qty_regular) || !empty($request->qty_32) || !empty($request->qty_50)){

        	$discount_amount = !empty($request->discount_amount) ? $request->discount_amount : 0;
       		$coupon_id = !empty($request->coupon_id) ? $request->coupon_id : 0;
       		
            $total_amount += ($request->qty_regular * 12) + ($request->qty_32 * 32) + ($request->qty_50 * 50)-$discount_amount;
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

        if(empty($request->exp_month) && empty($request->exp_year) && empty($request->card_number) && empty($request->cvv) && empty($request->cardholder_name)){
        	flash('Please provide proper card details.')->error();
        	return redirect()->back();
        }

        try{
	        $qty_regular = !empty($request->qty_regular) ? $request->qty_regular : 0;
	        $qty_32 = !empty($request->qty_32) ? $request->qty_32 : 0;
	        $qty_50 = !empty($request->qty_50) ? $request->qty_50 : 0;
	        $reload_amount = !empty($request->reload_amount) ? $request->reload_amount : 0;
	        $relaod_group_amount = !empty($request->relaod_group_amount) ? $request->relaod_group_amount : 0;
	        $reload_number = !empty($request->reload_number) ? $request->reload_number : '';
	        $group_name = !empty($request->group_name) ? $request->group_name : '';
	        $group_id = !empty($request->group_id) ? $request->group_id : '';
	        $user_id = !empty(Auth::id()) ? Auth::id() : '';

	        if(!empty($user_id)){
	        	$description .= " by user " . Auth::user()->contact->firstname . " " . Auth::user()->contact->lastname;
	        }

        	Stripe::setApiKey(config('services.stripe.secret'));
        	$card_token = Token::create([ 
	                                "card" => [
	                                    "exp_month" => $request->exp_month,
	                                    "exp_year"  => $request->exp_year,
	                                    "number"    => $request->card_number,
	                                    "cvc"       => $request->cvv,
	                                    "name"      => $request->cardholder_name,
	                                ],
	                            ]);

        	$payment_transaction = Payment_transaction::create(['nonce' => $card_token->id, 'type' => 'stripe', 'status' => 'processing', 'amount' => sprintf('%0.2f', $total_amount)]);

        	$result = Charge::create(array(
										"amount" => ($total_amount * 100),
										"currency" => "EUR",
										"source" => $card_token->id,
										"description" => $description,
									));
        	if ($result->paid){
				$payment_transaction->status = "success";
				$payment_transaction->response = $result;
				$payment_transaction->transation_id = $result->id;
				$payment_transaction->save();

				if(!empty($qty_regular) || !empty($qty_32) || !empty($qty_50)){
					$this->buy_card($qty_regular, $qty_32, $qty_50, $user_id, $payment_transaction->transation_id,$coupon_id);
					flash('Your order is considered, Our team member will contact you.')->success();
					return redirect()->route('online_shop');
		        }
		        elseif(!empty($reload_amount) && !empty($reload_number)){
		            $this->reload_card($request, $reload_number, $total_amount, $payment_transaction->transation_id);
		            flash('You card is reloaded.')->success();
		            return redirect()->route('online_shop', 'recharge');
		        }
		        elseif(!empty($group_id) && !empty($group_name)){
		            $this->reload_group($request, $group_id, $total_amount, $payment_transaction->transation_id, $group_name, $user_id);
		            flash('You group is reloaded.')->success();
		            if(!empty($user_id)){
		            	return redirect()->route('dashboard.auto_reload', 'advance');
		            }
		            else{
		            	return redirect()->route('group-deposit', [$group_id, $group_name]);	
		            }
		        }
		        else{
		        	$orderLog = new Logger('order');
			        $orderLog->pushHandler(new StreamHandler(storage_path('logs/stripe.log')), Logger::INFO);
			        $orderLog->info('SMSLimitLog_1', ['qty_regular' => $qty_regular, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'reload_number' => $reload_number, 'group_id' => $group_id, 'group_name' => $group_name, 'total_amount' => $total_amount, 'txn_id' => $payment_transaction->transation_id]);

		        	$payment_transaction->status = "need_to_refund";
		        	$payment_transaction->save();
		        	flash("Faied to procced, Your money will be refunded. If you have query, please contact us.")->error();
		        	return redirect()->back();
		        }
			}
			else{
				$orderLog = new Logger('order');
		        $orderLog->pushHandler(new StreamHandler(storage_path('logs/stripe.log')), Logger::INFO);
		        $orderLog->info('SMSLimitLog_1', ['qty_regular' => $qty_regular, 'qty_32' => $qty_32, 'qty_50' => $qty_50, 'reload_number' => $reload_number, 'group_id' => $group_id, 'group_name' => $group_name, 'total_amount' => $total_amount, 'txn_id' => $payment_transaction->transation_id]);

				$payment_transaction->status = "failed";
				$payment_transaction->response = $result;
				$payment_transaction->save();
				flash("Your payment is failed.")->error();
				return redirect()->back();
			}
        }
        catch(\Exception $e){
        	$orderLog = new Logger('order');
	        $orderLog->pushHandler(new StreamHandler(storage_path('logs/stripe.log')), Logger::INFO);
	        $orderLog->info('SMSLimitLog_2', $request->all());
	        
        	flash($e->getMessage())->error();
        	return redirect()->back();
	    }
    }
}
