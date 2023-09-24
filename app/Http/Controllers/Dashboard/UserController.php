<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * Show the login user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($dashboard = '')
    {
    	$advance = 'n';
    	if($dashboard == 'advance')
    		$advance = 'y';

        $countries = Country::orderBy('name')->get();
        return view('pages.dashboard.profile')->with(['advance_view' => $advance, 'countries' => $countries, 'user' => Auth::user()]);
    }

    
}
