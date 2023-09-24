<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['namespace'=>'api\v1', 'prefix'=>'v1'], function(){
	/* Login */
	Route::post('login', 'UserController@login');
	/* Registration */
	Route::post('register', 'UserController@register');
	/* Forgot Password */
	Route::post('forgotpassword', 'UserController@forgotPassword');
	/* Get Countries */
    Route::get('getCountries','UserController@get_countries');
    /* Get Countries */
    Route::post('getCallRate','ActionController@get_call_rate');
	/* Get Znes */
    Route::get('zones','UserController@get_zones');

    Route::post('call_card_api', 'UserController@card_api_call');
    Route::post('testApi', 'StripeController@test_api');
});

Route::group(['namespace'=>'api\v1', 'prefix'=>'v1', 'middleware'=>['auth:api']], function(){
	/* Change Password */
	Route::post('changepassword', 'UserController@changePassword');
    /* Get User Profile */
    Route::post('profile', 'UserController@profile');
    /* User logout */
    Route::post('logout', 'UserController@logout');
    /* Edit Profile */
    Route::post('editProfile','UserController@editProfile');
    /* Edit Profile Photo */
    Route::post('editPhoto','UserController@editPhoto');
    /* Get Active User Cards */
    Route::post('getCards','UserController@get_cards');
    /* Get Active User Cards */
    Route::post('getLandlineCountries','ActionController@get_landline_country_list');
    /* Get Landline Numbers */
    Route::post('getLandlineNumbers','ActionController@get_landline_numbers');
    /* Remove card from account */
    Route::post('deleteCard','ActionController@delete_card');
    /* Refer a friend */
    Route::post('refer','ActionController@refer');
    /* Refer a friend */
    Route::post('referralList','ActionController@refer_list');
    /* Refer a friend */
    Route::post('gprsPackages','ActionController@gprs_package_list');
    /* Send Otp */
    Route::post('sendOtp','ActionController@send_otp');
    /* Verify Otp */
    Route::post('verifyOtp','ActionController@verify_otp');

    /* Get Client Token */
    Route::post('getClientToken', 'BraintreePayment@get_client_token');
    /* Make Transaction */
    Route::post('makeTransaction', 'StripeController@make_transaction');
    /* Make Transaction */
    Route::post('testPayment', 'StripeController@make_payment');
    /* Make Transaction */
});
