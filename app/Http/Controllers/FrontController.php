<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Country;
use App\Models\Gprs_package;
use App\Models\Press;
use App\Models\SpecialPackage;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
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
    public function features()
    {
        return view('pages.front.features');
    }

    public function about()
    {
    	return view('pages.front.about');
    }

    public function online_shop(Request $request, $type = "buy")
    {
        $zones_data = $special_packages = $zone_packages = [];
        $zones = Zone::pluck('countries')->toArray();

        foreach ($zones as $zone) {
            $zones_data[] = explode(',', $zone);
        }
        $special_packages = SpecialPackage::get();
        $gprs_packages = Gprs_package::get();
        foreach ($gprs_packages as $package) {
            $zone_packages[$package->zone_id][] = $package;
        }

        $countries = Country::orderBy('name')->get();
        if(!empty($request->amount && $request->card_number)){
            return view('pages.front.online_shop', ['countries' => $countries, 'set_reload_amount' => true, 'reload_amount' => $request->amount, 'reload_number' => $request->card_number]);
        }
    	return view('pages.front.online_shop', ['countries' => $countries, 'set_reload_amount' => false, 'select_type' => $type, 'zones' => $zones_data, 'special_packages' => $special_packages, 'zone_packages' => $zone_packages]);
    }

    public function support()
    {
    	return view('pages.front.support');
    }

    public function reseller()
    {
        return view('pages.front.reseller');
    }

    public function press()
    {
        $presses = $televisions = [];
        $press_lng = Press::where(['type' => 'press'])->pluck('language')->toArray();
        $television_lng = Press::where(['type' => 'television'])->pluck('language')->toArray();
       
        foreach ($press_lng as $lng) {
            $presses[$lng] = Press::where(['type' => 'press', 'language' => $lng])->get(['title', 'link'])->toArray();
        }
        foreach ($television_lng as $lng) {
            $televisions[$lng] = Press::where(['type' => 'television', 'language' => $lng])->get(['title', 'link'])->toArray();
        }
        
        return view('pages.front.press', compact('presses', 'televisions'));
    }

    public function press_inner()
    {
        return view('pages.front.press_inner');
    }

    public function general_sales()
    {
        $content = Content::where('constant', 'sales')->value('content');
        return view('pages.front.general_sales', ['page_content' => $content]);
    }

    public function privacy_policy()
    {
        $content = Content::where('constant', 'privacy')->value('content');
        return view('pages.front.privacy_policy', ['page_content' => $content]);
    }

    public function terms()
    {
        $content = Content::where('constant', 'terms')->value('content');
        return view('pages.front.terms', ['page_content' => $content]);
    }
public function sitemap()
    {
    	return view('pages.front.sitemap');
    }

}
