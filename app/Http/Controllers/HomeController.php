<?php

namespace App\Http\Controllers;

use App\Models\Call_rate;
use App\Models\Card;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Reload_data;
use App\Models\TempExpiredCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = $this->get_active_country_rates();
        $rate_data = $this->get_rates('Germany', 'United Arab Emirates');
        $content = Content::where('constant', 'home')->value('content');

        return view('home', ['counties' => $counties, 'rate_data' => $rate_data, 'page_content' => $content]);
    }

    public function get_active_country_rates(){
        return Call_rate::where('active', 1)->distinct()->orderBy('country')->get(['country']); //where('zone_rate', '<>', NULL)
    }

    public function get_country_rate_list($country = ''){
        return Call_rate::where('country', $country)->where('active', 1)->get();
        // return Call_rate::where('country', 'like', '%' . $country . '%')->where('active', 1)->get();
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
            if(empty($rate_data['extra']) || !empty($rate->extra_rate) && $rate_data['extra'] > $rate->extra_rate) $rate_data['extra'] = $rate->extra_rate;
            if(empty($rate_data['call_received_price_to']) || !empty($rate->call_in_rate) && $rate_data['call_received_price_to'] > $rate->call_in_rate) $rate_data['call_received_price_to'] = $rate->call_in_rate;
        }

        return $rate_data;
    }

    public function change_rate(Request $request){
        $content = ['status' => 204, 'message' => 'Something went wrong.'];
        $from_country = $request->from_country;
        $to_country = $request->to_country;

        if(!empty($from_country)){
            if(!empty($to_country)){
                $content['rate_data'] = $this->get_rates($from_country, $to_country);
                $content['status'] = 200;
                $content['message'] = "Success";
            }
            else{
                $content['message'] = "Calling to country is required.";
            }
        }
        else{
            $content['message'] = "Roaming to country is required.";
        }
        return response()->json($content);
    }

    public function get_expired_cards()
    {
        $expired_cards = TempExpiredCard::groupBy('number')->pluck('number')->toArray();
        $reloaded_cards = Reload_data::whereIn('number', $expired_cards)->groupBy('number')->pluck('number')->toArray();
        $cards = Card::whereIn('card_number', $expired_cards)->whereNotIn('card_number', $reloaded_cards)->groupBy('card_number')->orderBy('user_id')->get();
        $sheet_array = [];
        $sheet_array[] = ['Card Number', 'Card Balance', 'First Name', 'Last Name', 'Email Address'];

        foreach ($cards as $card) {
            $sheet_array[] = [$card->card_number, $card->card_balance, $card->user->contact->firstname, $card->user->contact->lastname, $card->user->username];
        }

        \Excel::create('Expired Cards', function($excel) use($sheet_array) {
            $excel->sheet('Expired Cards', function($sheet) use($sheet_array){
                $sheet->setAllBorders('thin');
                $sheet->fromArray($sheet_array ,null, 'A1', true, false);            
            });
        })->export('xlsx');
    }
}
