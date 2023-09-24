<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\CardApiController;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;

use App\Models\Payment_transaction;
use App\Mail\CardReload;
use App\Mail\AdminCardReload;
use App\Models\Reload_data;
use App\Models\Card;
use PDF;

class StripeController extends Controller
{
    public function make_payment(Request $request)
    {
    	$rules = [
    		'card_token' => 'required',
    	];

    	if($this->ApiValidator($request->all(), $rules)) {
    		try{
    			Stripe::setApiKey(config('services.stripe.secret'));

				Charge::create(array(
					"amount" => 100,
					"currency" => "EUR",
					"source" => $request->card_token,
					"description" => "Charge for payment"
				));

	    		$this->status = $this->statusArr['success'];   
			    $this->response['message'] = "Card added successfully.";
		    }
		    catch(\Exception $e){
		    	$this->response['message'] = $e->getMessage();
		    }
    	}

    	return $this->return_response();
    }

    public function make_transaction(Request $request)
    {
    	$rules = [
            'token'=>'required',
            'amount'=>'required',
            'card_number'=>'required'
        ];

        if($this->ApiValidator($request->all(), $rules)){
        	try{
	        	if($this->check_card($request, $request->card_number)){
	        		$nonceFromTheClient = $request->token;

			    	$payment_transaction = Payment_transaction::where(['nonce' => $nonceFromTheClient, 'type' => 'stripe'])->first();

			    	if(empty($payment_transaction) || $payment_transaction->isEmpty()){
			    		$payment_transaction = Payment_transaction::create(['nonce' => $nonceFromTheClient, 'type' => 'stripe', 'status' => 'processing', 'amount' => sprintf('%0.2f', $request->amount)]);

			    		Stripe::setApiKey(config('services.stripe.secret'));

						$result = Charge::create(array(
										"amount" => ($request->amount * 100),
										"currency" => "EUR",
										"source" => $nonceFromTheClient,
										"description" => "Charge for Reload Card " . $request->card_number . " Of User " . Auth::user()->contact->firstname . " " . Auth::user()->lastname
									));

						if ($result->paid){
							$payment_transaction->status = "success";
							$payment_transaction->response = $result;
							$payment_transaction->transation_id = $result->id;
							$payment_transaction->save();

							if($this->reload_card($request, $request->card_number, $request->amount)){
								$reload_data = Reload_data::create(['payment_transaction_id' => $payment_transaction->id, 'number' => $request->card_number, 'amount' => $request->amount, 'validity' => date('Y-m-d', strtotime("+1 year")), 'transaction_id' => $payment_transaction->transation_id]);

		                        $pdf = PDF::loadView('pages/format', ['transaction_id' => $payment_transaction->transation_id, 'item' => "Reload a card", 'qty' => 1, 'price' => $request->amount, 'total_amount' => $request->amount, 'address' => Auth::user()->contact->address, 'city' => Auth::user()->contact->city, 'state' => Auth::user()->contact->state, 'zip' => Auth::user()->contact->zip, 'country' => (!empty(Auth::user()->contact->country) ? Auth::user()->contact->country->name : '')]);
		                        $pdf->save(public_path('files/invoice.pdf'));

		                        Mail::to(Auth::user()->username)->send(new CardReload(['name' => Auth::user()->contact->firstname, 'card' => $request->card_number, 'amount' => $request->amount, 'date' => $reload_data->validity]));
                        		Mail::to('info@xxsim.com')->send(new AdminCardReload(['name' => Auth::user()->contact->firstname, 'card' => $request->card_number, 'amount' => $request->amount, 'transation_id' => $payment_transaction->transation_id]));

                        		Card::where('card_number', $request->card_number)->update(['card_validity' => date('Y-m-d', strtotime("+1 year"))]);

								$this->status   = $this->statusArr['success'];
	                			$this->response['message']  = "Payment and recharge successfully done.";
							}
							else{
								$payment_transaction->status = 'need_to_refund';
								$payment_transaction->save();
							}
						}
						else{
							$payment_transaction->status = "failed";
							$payment_transaction->response = $result;
							$payment_transaction->save();
							$this->response['message'] = "Payment failed.";
						}
			    	}
			    	else{
			    		$this->response['message'] = "Transacrtion already occured with this nonce.";
			    		$this->response['payment_status'] = $payment_transaction->status;
			    	}
	        	}
	        	else{
	        		$this->response['message'] = "Only XXSIM cards are allowed.";
	        	}
	        }
	        catch(\Exception $e){
		    	$this->response['message'] = $e->getMessage();
		    }
		}
		return $this->return_response();
    }

    public function check_card(Request $request, $number = '37281720314')
    {
    	if(!empty($number)){
    		$card_api = new CardApiController();

    		$data = ['api_name'=> 'get_balance', 'card'=> $number];
            $response = $card_api->card_api($request, $data);

            if($response['status'] == 200){
            	return true;
            }
            else{
            	return false;
            }
    	}
    	else{
    		return false;
    	}
    }

    public function reload_card(Request $request, $number = '37281720314', $amount = 01)
    {
        if(!empty($number)){
        	$card_api = new CardApiController();
            $data = ['api_name'=> 'account_details'];
        
	        $response = $card_api->card_api($request, $data);

	        if($response['status'] == 200){
	            $result = json_decode($response['result']);
	            $data = ['api_name'=> 'reload', 'card'=> $number, 'amount'=> $amount, 'orderid'=> ($result->orderid+1)];
	            $response = $card_api->card_api($request, $data);

	            if($response['status'] == 200){
	            	return true;
	            }
	            else{
	            	return false;
	            }
	        }
	        else{
	        	return false;
	        }
        }
        else{
        	return false;
        }
    }

    public function test_api(Request $request)
    {
    	var_dump(json_decode($request->user_items));
    }
}