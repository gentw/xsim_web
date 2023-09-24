<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use braintree\braintree_php\lib\Braintree;
use App\Http\Controllers\Dashboard\CardApiController;
use Illuminate\Support\Facades\Mail;

use App\Models\Payment_transaction;
use App\Mail\CardReload;
use App\Models\Reload_data;

class BraintreePayment extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $gateway;

    public function __construct()
    {
        /*$this->gateway = new \Braintree_Gateway([
		    'environment' => 'sandbox',
		    'merchantId' => 'x9bp3qn5hcb6y4tg', // p5x46fmkjcccgfs8
		    'publicKey' => 'nrpvcd2jgp8mgrt2', // vd8tx775dywrwbxd
		    'privateKey' => '666da8af0b9fc745b2cbf711f9f341a2' // fb74a1fef16dd30976a3a85569f52ca8
		]);*/

		$this->gateway = new \Braintree_Gateway([
			'environment' => 'production',
			'merchantId' => 'hhqr6zrbvttgyv4c',
			'publicKey' => 'v8yp8p7xht674xf6',
			'privateKey' => 'f6a1bd5feb65fe7d99f689651271edc9'
		]);

    }

    public function get_client_token()
    {
    	try{
    		echo $this->gateway->clientToken()->generate();
    	}
    	catch (\Braintree_Exception_NotFound $e){
    		echo "error";
    		print_r($e->getMessage());
    	}
    	exit;

    	$this->status = $this->statusArr['success'];
        $this->response['message'] = trans('api.success');
        $this->response['data']['client_token'] = $this->gateway->clientToken()->generate();
    	return $this->return_response();
    }

    public function make_transaction(Request $request)
    {
    	$rules = [
            'payment_nonce'=>'required',
            'amount'=>'required',
            'card_number'=>'required'
        ];

        if($this->ApiValidator($request->all(), $rules)){
        	if($this->check_card($request, $request->card_number)){

        		$nonceFromTheClient = $request->payment_nonce;

		    	$payment_transaction = Payment_transaction::where(['nonce' => $nonceFromTheClient, 'type' => 'braintree'])->first();

		    	if(true){
		    		$payment_transaction = Payment_transaction::create(['nonce' => $nonceFromTheClient, 'type' => 'braintree', 'status' => 'processing', 'amount' => sprintf('%0.2f', $request->amount)]);

		    		$result = $this->gateway->transaction()->sale([
						'amount' => sprintf('%0.2f', $request->amount),
						'paymentMethodNonce' => $nonceFromTheClient,
						'options' => [
							'submitForSettlement' => True
						]
					]);

					if ($result->success){
						$payment_transaction->status = "success";
						$payment_transaction->response = $result;
						$payment_transaction->transation_id = $result->transaction->id;
						$payment_transaction->save();

						if($this->reload_card($request, $request->card_number, $request->amount)){
							$reload_data = Reload_data::create(['payment_transaction_id' => $payment_transaction->id, 'number' => $request->card_number, 'amount' => $request->amount, 'validity' => date('Y-m-d', strtotime("+1 year")), 'transaction_id' => $payment_transaction->transation_id]);

	                        Mail::to(Auth::user()->username)->send(new CardReload(['name' => Auth::user()->contact->firstname, 'card' => $request->card_number, 'amount' => $request->amount, 'date' => $reload_data->validity]));

							$this->status   = $this->statusArr['success'];
                			$this->response['message']  = "Payment and recharge successfully done.";
						}
						else{
							$payment_transaction->status = 'need_to_refund';
							$payment_transaction->save();
						}
					} 
					else if ($result->transaction){
						$payment_transaction->status = "failed";
						$payment_transaction->response = $result;
						$payment_transaction->save();
						$this->response['message'] = $result->transaction->processorResponseText;
						// $this->response['payment_error'] = [['error_code' => $result->transaction->processorResponseCode, 'message' => $result->transaction->processorResponseText]];
					} 
					else{
						$payment_transaction->status = "failed";
						$payment_transaction->response = $result;
						$payment_transaction->save();
						$errors = [];
						// foreach($result->errors->deepAll() AS $error) {
						// 	$errors[] = ['error_code' => $error->code, 'message' => $error->message];
						// }
						foreach($result->errors->deepAll() AS $error) {
							$errors[] = $error->message;
						}
						$this->response['message'] = $errors[0];
						// $this->response['payment_error'] = $errors;
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
}
