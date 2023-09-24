<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Gprs_package;
use App\Models\National_number;
use App\Models\Reload_data;
use App\Models\SpecialPackage;
use App\Models\Zone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth');
    }

    public function checkApi(){
        $result = file_get_contents("http://whitelabel.travelsim.com/send_server_ip.php");
        print_r($result);
        exit;
    }

    /**
     * Show the login user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_card(){
        return view('pages.dashboard.add_card');
    }

    /**
     * Show and add the referrals list of login user.
     *
     * @return \Illuminate\Http\Response
     */
    public function referrals(){
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
        return view('pages.dashboard.referrals', ['refers' => $refers]);
    }

    /**
     * Show the history of card.
     * 
     * @return \Illuminate\Http\Response
     */
    public function history(){
        return view('pages.dashboard.history');
    }

    /**
     * 
     * @return [type] [description]
     */
    public function auto_reload($dashboard = ''){
        $advance = 'n';
        if($dashboard == 'advance')
            $advance = 'y';

        return view('pages.dashboard.auto_reload')->with('advance_view', $advance);
    }

    /**
     * [geolocalization description]
     * @return [type] [description]
     */
    public function geolocalization(){
        return view('pages.dashboard.geolocalization')->with('advance_view', 'y');
    }

    /**
     * [landline_activation description]
     * @return [type] [description]
     */
    public function landline_activation(){
        // $countries = Country::all();
        $countries = National_number::where(['active' => 1])->distinct()->get(['country']);
        return view('pages.dashboard.landline_activation', ['advance_view' => 'y', 'countries' => $countries]);
    }

    /**
     * [landline_activation description]
     * @return [type] [description]
     */
    public function landline_activation_number(){
        // $countries = Country::all();
        return view('pages.dashboard.landline_activation_numbers', ['advance_view' => 'y']);
    }

    /**
     * [GPRS Zone List]
     * @return [type] [description]
     */
    public function zone_list(){
        $zones = Zone::pluck('countries')->toArray();

        foreach ($zones as $zone) {
            $data[] = explode(',', $zone);
        }
        $special_packages = SpecialPackage::get();
        return view('pages.dashboard.gprs',compact('special_packages'))->with(['advance_view' => 'y', 'zones' => $data]);
    }

    /**
     * [gprs_package description]
     * @return [type] [description]
     */
    public function gprs_package($zone_id = 1){
        $selected_zone = $zone_id;
        // $countries = [];
        // $selected_zone = null;
        // $zones = Zone::where('countries', '<>', '')->get();
        // foreach ($zones as $zone) {
        //     $zone_countries = explode(', ', $zone->countries);
        //     if(in_array('United Arab Emirate', $zone_countries)){
        //         $selected_zone = $zone->id;
        //     }
        //     $countries = array_merge($countries, $zone_countries);
        // }
        // sort($countries);

        if(!empty($selected_zone)){
            $gprs_packages = Gprs_package::where('zone_id', $selected_zone)->get();
        }
        else{
            $gprs_packages = [];
        }
        return view('pages.dashboard.gprs_package')->with(['advance_view' => 'y', 'gprs_packages' => $gprs_packages]); //'countries' => $countries,
    }

    public function add_reload_data(Request $request)
    {
        Reload_data::create(['number' => $request->number, 'amount' => $request->amount, 'validity' => date('Y-m-d', strtotime("+1 year"))]);
    }
}
