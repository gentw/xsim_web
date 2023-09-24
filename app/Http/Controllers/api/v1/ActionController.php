<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Dashboard\CardApiController;

use App\Mail\Referral as Referral_mail;
use App\Mail\AddCard;
use App\Models\Call_rate;
use App\Models\Card;
use App\Models\Referral;
use App\Models\National_number;
use App\Models\Gprs_package;
use App\Models\Zone;
use App\User;

class ActionController extends Controller
{
	public function get_call_rate(Request $request){
		$rules = [
    		'from_country' => 'required',
    		'to_country' => 'required'
    	];
    	if($this->ApiValidator($request->all(), $rules)) {
    		$this->status = $this->statusArr['success'];   
		    $this->response['message'] = trans('api.list', ['entity' => 'call rate']);
		    $this->response['data'] = $this->get_rates($request->from_country, $request->to_country);
    	}
    	return $this->return_response();
	}

    public function get_rates($from_country, $to_country){
        $rate_data = [
            'call_price' => 0.00,
            'call_received_price_from' => 0.00,
            'call_received_price_to' => 0.00,
            'sms_price' => 0.00,
            'gprs_price' => 0.00,
            'xxsim_price' => 0.00,
            'xxsim_sms_price' => 0.00,
            'extra' => 0.00,
        ];
        
        $from_rate_list = $this->get_country_rate_list($from_country);
        $to_rate_list = $this->get_country_rate_list($to_country);

        foreach($from_rate_list as $rate){
            if(empty($rate_data['call_price']) || !empty($rate->call_out_rate) && $rate_data['call_price'] > $rate->call_out_rate) $rate_data['call_price'] = $rate->call_out_rate;
            if(empty($rate_data['call_received_price_from']) || !empty($rate->call_in_rate) && $rate_data['call_received_price_from'] > $rate->call_in_rate) $rate_data['call_received_price_from'] = $rate->call_in_rate;
            if(empty($rate_data['sms_price']) || !empty($rate->sms_out_rate) && $rate_data['sms_price'] > $rate->sms_out_rate) $rate_data['sms_price'] = $rate->sms_out_rate;    
            if(empty($rate_data['gprs_price']) || !empty($rate->gprs_rate) && $rate_data['gprs_price'] > $rate->gprs_rate) $rate_data['gprs_price'] = $rate->gprs_rate;
            if(empty($rate_data['xxsim_price']) || !empty($rate->xxsim_call_rate) && $rate_data['xxsim_price'] > $rate->xxsim_call_rate) $rate_data['xxsim_price'] = $rate->xxsim_call_rate;
            if(empty($rate_data['xxsim_sms_price']) || !empty($rate->xxsim_sms_rate) && $rate_data['xxsim_sms_price'] > $rate->xxsim_sms_rate) $rate_data['xxsim_sms_price'] = $rate->xxsim_sms_rate;
        }

        foreach ($to_rate_list as $rate){
            if(!empty($rate->extra_rate) && $rate_data['extra'] > $rate->extra_rate) $rate_data['extra'] = $rate->extra_rate;
            if(!empty($rate->call_in_rate) && $rate_data['call_received_price_to'] > $rate->call_in_rate) $rate_data['call_received_price_to'] = $rate->call_in_rate;
        }

        return $rate_data;
    }

    public function get_country_rate_list($country = ''){
        return Call_rate::where('country', 'like', '%' . $country . '%')->where('active', 1)->get();
    }

    public function get_landline_country_list(Request $request){
        $this->status = $this->statusArr['success'];   
        $this->response['message'] = trans('api.list', ['entity' => 'landline country list']);
        $this->response['data'] = National_number::distinct()->get(['country']);
        return $this->return_response();
    }

    public function get_landline_numbers(Request $request){
        $rules = [
            'country' => 'required',
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            $this->status = $this->statusArr['success'];   
            $this->response['message'] = trans('api.list', ['entity' => 'landline numbers']);
            $this->response['data'] = National_number::where('country', 'like', $request->country)->where('allocated', 0)->get();
        }
        return $this->return_response();
    }

    public function delete_card(Request $request){
        $rules = [
            'number' => 'required',
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            $card = Card::where(['user_id' => Auth::id(), 'card_number' => $request->number])->first();
            if(!empty($card)){
                Card::destroy($card->id);
                $this->status = $this->statusArr['success'];   
                $this->response['message'] = trans('api.delete', ['entity' => 'card']);
                $this->response['data'] = Auth::user()->cards;
            }
            else{
                $this->response['message'] = trans('api.not_found', ['entity' => 'card']);
            }
        }
        return $this->return_response();
    }

    public function refer(Request $request){
        $rules = [
            'email' => 'required|email',
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            $user = User::where('username', $request->username)->count();
            if($user){
                $this->response['message'] = trans('api.registered');
            }
            else{
                $refer = Referral::where(['user_id' => Auth::id(), 'email' => $request->email])->count();
                if($refer){
                    $this->response['message'] = trans('api.refered');
                }
                else{
                    Mail::to($request->email)->send(new Referral_mail());
                    Referral::create(['user_id' => Auth::id(), 'email' => $request->email]);
                    $this->status = $this->statusArr['success'];
                    $this->response['message'] = trans('api.refer_email');
                }
            }
        }
        return $this->return_response();
    }

    public function refer_list(Request $request){
        $refers = [];
        foreach (Auth::user()->referrals as $referral) {
            $user = User::where('username', $referral->email)->count();
            if($user){
                $refers[] = ['email' => $referral->email, 'sign_up_status' => 'y'];
            }
            else{
                $refers[] = ['email' => $referral->email, 'sign_up_status' => 'n'];   
            }
        }
        $this->status = $this->statusArr['success'];
        $this->response['message'] = trans('api.list', ['entity' => 'Refer list']);
        $this->response['data'] = $refers;
        return $this->return_response();
    }

    public function gprs_package_list(Request $request){
        $rules = [
            'zone_id' => 'required',
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            // $zones = Zone::where('countries', '<>', '')->get();
            // foreach ($zones as $zone) {
            //     $zone_countries = explode(', ', $zone->countries);
            //     if(in_array($request->country, $zone_countries)){
            //         $selected_zone = $zone->id;
            //         break;
            //     }
            // }

            $selected_zone = $request->zone_id;
            if(!empty($selected_zone)){
                $gprs_packages = Gprs_package::where('zone_id', $selected_zone)->get();
                $this->status = $this->statusArr['success'];
                $this->response['message'] = trans('api.list', ['entity' => 'GPRS package list']);
                $this->response['data'] = $gprs_packages;
            }
            else{
                $this->response['message'] = trans('api.package_not_found');
            }
        }
        return $this->return_response();
    }

    public function send_otp(Request $request){
        $rules = [
            'number' => 'required',
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            $card = Card::where(['card_number' => $request->number, 'user_id' => Auth::id()])->active()->first();
            if(empty($card)){
                $card_api = new CardApiController();
                $data = ['api_name'=> 'get_balance', 'card'=> $request->number];
                $response = $card_api->card_api($request, $data);

                if($response['status'] == 200){
                    $otp = $this->get_unique_otp();
                    Mail::to(Auth::user()->username)->send(new AddCard(['name' => Auth::user()->contact->firstname, 'activation_code' => $otp]));
                    $data = ['api_name'=> 'sms', 'anum'=> $request->number, 'bnum'=> $request->number, 'msg'=> 'Activation code is ' . $otp];
                    $response = $card_api->card_api($request, $data);

                    if($response['status'] == 200){    
                        Card::create([
                            'user_id' => Auth::id(),
                            'card_number' => $request->number,
                            'verification_code' => $otp,
                        ]);

                        $this->status = $this->statusArr['success'];
                        $this->response['message'] = trans('api.send_activaion_code');
                        $this->response['data'] = ['activation_code' => $otp];
                    }
                    else{
                        $this->response['message'] = $response['message'];
                    }
                }
                else{
                    $this->response['message'] = $response['message'];
                }
            }
            else{
                $this->response['message'] = trans('api.exsist_card', ['entity' => 'your']);
                /*if($card->user_id == Auth::id()){
                    $this->response['message'] = trans('api.exsist_card', ['entity' => 'your']);
                }
                else{
                    $this->response['message'] = trans('api.exsist_card', ['entity' => 'another']);
                }*/
            }
        }
        return $this->return_response();
    }

    public function get_unique_otp(){
        $otp = rand(1000, 9999);
        $found = Card::where(['verification_code' => $otp, 'active' => 0])->first();
        if($found){
            return $this->get_unique_otp();
        }
        else{
            return $otp;
        }
    }

    public function verify_otp(Request $request){
        $rules = [
            'number' => 'required',
            'activation_code' => 'required'
        ];
        if($this->ApiValidator($request->all(), $rules)) {
            $card = Card::where(['card_number' => $request->number, 'user_id' => Auth::id()])->latest()->first();
            if(!empty($card)){
                if(!$card->active){
                    if($card->verification_code == $request->activation_code){
                        if($card->user_id == Auth::id()){
                            $card->active = 1;
                            $card->card_status = 1;
                            $card->verification_code = NULL;
                            if($card->save()){
                                Card::where(['card_number' => $request->number, 'active' => 0])->delete();

                                $card_api = new CardApiController();
                                /* Active Card */
                                $data = ['api_name'=> 'card_status', 'card'=> $request->number, 'block' => 'f'];
                                $response = $card_api->card_api($request, $data);
                                /* Active GPRS Service */
                                $data = ['api_name'=> 'gprs_service_status', 'card'=> $request->number, 'block' => 'f'];
                                $response = $card_api->card_api($request, $data);
                                /* Get Group Info */
                                $data = ['api_name'=> 'get_card_group_info', 'card'=> $request->number];
                                $response = $card_api->card_api($request, $data);  
                                if(empty($response['type'])){
                                    $result_card = json_decode($response['result'])->card;
                                    $card_balance = (!empty($result_card->card_balance)) ? $result_card->card_balance : NULL;
                                    $corp_maxlimit = (!empty($result_card->corp_maxlimit)) ? $result_card->corp_maxlimit : NULL;
                                    $corp_minlimit = (!empty($result_card->corp_minlimit)) ? $result_card->corp_minlimit : NULL;
                                    $corp_transaction = (!empty($result_card->corp_transaction)) ? $result_card->corp_transaction : NULL;
                                    $corp_enabled = (!empty($result_card->corp_enabled) && $result_card->corp_enabled == 'yes') ? 1 : 0;

                                    if(!empty($result_card->corp_group)){
                                        $corp_group = Group::where('group_id', $result_card->corp_group)->value('id');
                                    }

                                    if(!empty($corp_group)){
                                        Card::where('id', $card->id)->update(['card_balance' => $card_balance, 'group_id' => $corp_group, 'corp_maxlimit' => $corp_maxlimit, 'corp_minlimit' => $corp_minlimit, 'corp_transaction' => $corp_transaction, 'corp_enabled' => $corp_enabled]);
                                    }
                                }

                                $this->status = $this->statusArr['success'];
                                $this->response['message'] = trans('api.add_card');
                                $this->response['data'] = Auth::user()->cards;
                            }
                            else{
                                $this->response['message'] = trans('api.something_wrong');
                            }
                        }
                        else{
                            $this->response['message'] = trans('api.not_add_you');
                        }
                   }
                   else{
                        $this->response['message'] = trans('api.not_match_otp');
                   }
                }
                else{
                    $this->response['message'] = trans('api.exsist_card', ['entity' => 'your']);
                    /*if($card->user_id == Auth::id()){
                        $this->response['message'] = trans('api.exsist_card', ['entity' => 'your']);
                    }
                    else{
                        $this->response['message'] = trans('api.exsist_card', ['entity' => 'another']);
                    }*/
                }
            }
            else{
                $this->response['message'] = trans('api.not_found', ['entity' => 'card']);
            }
        }
        return $this->return_response();
    }
}
