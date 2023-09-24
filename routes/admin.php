<?php

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/home', 'HomeController@index')->name('home.index');

    /* Required auth and permission middleware */
    Route::group(['middleware' => ['revalidate', 'permission']], function () {

        /* My Profile */
        Route::get('profile', 'UserController@showProfile')->name('profile.show');
        Route::post('profile', 'UserController@editProfile')->name('profile.edit');

        Route::get('user/listing', 'UserMgmtController@listing')->name('user.listing');
        Route::get('user/{id}/card/listing', 'UserMgmtController@card_listing')->name('user.card_listing');
        Route::get('user/card/{id}/addBalance', 'UserMgmtController@add_balance')->name('user.add_balance');
        Route::post('user/card/addBalance', 'UserMgmtController@add_card_balance')->name('user.add_card_balance');
        Route::get('user/card/{id}/addNationalNumber', 'UserMgmtController@add_number')->name('user.add_number');
        Route::post('user/card/addExtraNumber', 'UserMgmtController@add_extra_number')->name('user.add_extra_number');
        Route::delete('user/card/{id}/removeNationalNumber', 'UserMgmtController@remove_number')->name('user.remove_number');
        Route::get('user/card/{id}/removeNationalNumber/list', 'UserMgmtController@national_number_list')->name('user.remove_number_list');
        Route::delete('user/{user_id}/card/{card_id}', 'UserMgmtController@remove_user_card')->name('user.remove_card');
        Route::get('user/{id}/card/add', 'UserMgmtController@card_add')->name('user.card_add');
        Route::post('user/card/add', 'UserMgmtController@add_user_card')->name('user.add_user_card');
        Route::get('user/{id}/cards', 'UserMgmtController@cards')->name('user.cards');
        Route::get('user/card/{id}/change/validity', 'UserMgmtController@change_validity')->name('user.change_validity');
        Route::post('user/card/change/validity', 'UserMgmtController@update_validity')->name('user.update_validity');
        Route::resource('user', 'UserMgmtController');

        Route::get('rate/listing', 'CallRatesController@listing')->name('rate.listing');
        Route::post('import-rate-file', 'CallRatesController@import')->name('rate.import');
        Route::resource('rate', 'CallRatesController');

        Route::get('number/listing', 'NumberController@listing')->name('number.listing');
        Route::post('import-number-file', 'NumberController@import')->name('number.import');
        Route::resource('number', 'NumberController');

        Route::get('order/listing', 'OrderController@listing')->name('order.listing');
        Route::resource('order', 'OrderController');

        Route::get('content/listing', 'ContentController@listing')->name('content.listing');
        Route::resource('content', 'ContentController');

        Route::get('reload/listing', 'ReloadController@listing')->name('reload.listing');
        Route::resource('reload', 'ReloadController');

        Route::get('group-reload/listing', 'GroupReloadController@listing')->name('group-reload.listing');
        Route::resource('group-reload', 'GroupReloadController');

        Route::get('presses/listing', 'PressController@listing')->name('presses.listing');
        Route::resource('presses', 'PressController');

        Route::get('coupons/listing', 'CouponController@listing')->name('coupons.listing');
        Route::resource('coupons', 'CouponController');
    });

    /* Required auth middleware */
    Route::group(['middleware' => ['revalidate']], function () {
        Route::get('change-password', 'UserController@showChangePassword')->name('showChangePass');
        Route::post('change-password', 'UserController@changePassword')->name('changepass');
        Route::post('check-password', 'UserController@checkOldPassword')->name('checkoldpass');

        Route::post('unique-email', 'UserController@checkUniqueEmail')->name('uniqueemail');
        Route::post('unique-admin-email', 'UserController@checkUniqueAdminEmail')->name('uniqueAdminemail');
        Route::post('unique-email-others', 'UserController@checkUniqueEmailOtherthanMe')->name('uniqueemailothers');

        Route::get('myprofile', 'UserController@showProfile')->name('showProfile');
        Route::post('myprofile', 'UserController@editProfile')->name('editProfile');
        Route::post('national-numbers', 'UserController@national_numbers')->name('get_national_numbers');

        Route::post('upload_ck_file', 'ContentController@upload_ck_file')->name('upload_ck');

        Route::get('card-add', 'CallRatesController@country_add')->name('country_add');
        Route::post('card-add-mail', 'CallRatesController@sendMail')->name('country_add_mail');

        Route::get('users/ages/export', 'UserMgmtController@export_age_group')->name('user_age_export');
    });
});
