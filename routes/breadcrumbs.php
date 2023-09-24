<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs){
    $breadcrumbs->push('Dashboard', route('admin.home.index'));
});

// Edit Profile
Breadcrumbs::register('my_profile', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Profile', route('admin.showProfile'));
});

// Change Password
Breadcrumbs::register('change_pass', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Change Password', route('admin.showChangePass'));
});

//User Listing
Breadcrumbs::register('user', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Users', route('admin.user.index'));
});

//User Add
Breadcrumbs::register('add_user', function($breadcrumbs){
	$breadcrumbs->parent('user');
	$breadcrumbs->push('Add User', route('admin.user.create'));
});

//User Edit
Breadcrumbs::register('edit_user', function($breadcrumbs, $user){
	$breadcrumbs->parent('user');
	$breadcrumbs->push('Edit User', route('admin.user.edit', $user->id_user));
});

//User Show
Breadcrumbs::register('view_user', function($breadcrumbs, $user){
	$breadcrumbs->parent('user');
	$breadcrumbs->push(!empty($user->contact) ? ucwords($user->contact->firstname) . " " . ucwords($user->contact->lastname) : "View User", route('admin.user.show', $user->id_user));
});

//User Card List
Breadcrumbs::register('cards', function($breadcrumbs, $user){
	$breadcrumbs->parent('view_user', $user);
	$breadcrumbs->push('Card List', route('admin.user.cards', $user->id_user));
});

//Add Balnce To Card
Breadcrumbs::register('add_balance', function($breadcrumbs, $card){
	$breadcrumbs->parent('cards', $card->user);
	$breadcrumbs->push('Add Balance', route('admin.user.add_balance', $card->id));
});

//Add National Number To Card
Breadcrumbs::register('add_extra_number', function($breadcrumbs, $card){
	$breadcrumbs->parent('cards', $card->user);
	$breadcrumbs->push('Add National Number', route('admin.user.add_number', $card->id));
});

//Add National Number To Card
Breadcrumbs::register('edit_validity', function($breadcrumbs, $card){
	$breadcrumbs->parent('cards', $card->user);
	$breadcrumbs->push('Change Card Validity', route('admin.user.change_validity', $card->id));
});

//Add Card To User Account
Breadcrumbs::register('add_card', function($breadcrumbs, $user){
	$breadcrumbs->parent('cards', $user);
	$breadcrumbs->push('Add Card', route('admin.user.card_add', $user->id_user));
});

//Rate Listing
Breadcrumbs::register('rate', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Call Rates', route('admin.rate.index'));
});

//Rate Add
Breadcrumbs::register('add_rate', function($breadcrumbs){
	$breadcrumbs->parent('rate');
	$breadcrumbs->push('Add Call Rate', route('admin.rate.create'));
});

//Rate Edit
Breadcrumbs::register('edit_rate', function($breadcrumbs, $rate){
	$breadcrumbs->parent('rate');
	$breadcrumbs->push('Edit Call Rate', route('admin.rate.edit', $rate->id));
});
      
//Rate Show
Breadcrumbs::register('view_rate', function($breadcrumbs, $rate){
	$breadcrumbs->parent('rate');
	$breadcrumbs->push('View Call Rate', route('admin.rate.show', $rate->id));
});

//country add mail
Breadcrumbs::register('country_add_mail', function($breadcrumbs){
	$breadcrumbs->parent('rate');
	$breadcrumbs->push('Send Mail', route('admin.country_add'));
});

//National Number Listing
Breadcrumbs::register('number', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('National Numbers', route('admin.number.index'));
});

//National Number Add
Breadcrumbs::register('add_number', function($breadcrumbs){
	$breadcrumbs->parent('number');
	$breadcrumbs->push('Add National Number', route('admin.number.create'));
});

//National Number Edit
Breadcrumbs::register('edit_number', function($breadcrumbs, $number){
	$breadcrumbs->parent('number');
	$breadcrumbs->push('Edit National Number', route('admin.number.edit', $number->id));
});

//National Number Show
Breadcrumbs::register('view_number', function($breadcrumbs, $number){
	$breadcrumbs->parent('number');
	$breadcrumbs->push('View National Number', route('admin.number.show', $number->id));
});

//Card Order Listing
Breadcrumbs::register('order', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Card Orders', route('admin.order.index'));
});

//Card Order Add
Breadcrumbs::register('add_order', function($breadcrumbs){
	$breadcrumbs->parent('order');
	$breadcrumbs->push('Add Card Order', route('admin.order.create'));
});

//Card Order Edit
Breadcrumbs::register('edit_order', function($breadcrumbs, $order){
	$breadcrumbs->parent('order');
	$breadcrumbs->push('Edit Card Order', route('admin.order.edit', $order->id));
});

//Card Order Show
Breadcrumbs::register('view_order', function($breadcrumbs, $order){
	$breadcrumbs->parent('order');
	$breadcrumbs->push('View Card Order', route('admin.order.show', $order->id));
});

//Content Page Listing
Breadcrumbs::register('content', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Content Pages', route('admin.content.index'));
});

//Content Page Add
Breadcrumbs::register('add_content', function($breadcrumbs){
	$breadcrumbs->parent('content');
	$breadcrumbs->push('Add Content Page', route('admin.content.create'));
});

//Content Page Edit
Breadcrumbs::register('edit_content', function($breadcrumbs, $content){
	$breadcrumbs->parent('content');
	$breadcrumbs->push('Edit Content Page', route('admin.content.edit', $content->id));
});

//Content Page Show
Breadcrumbs::register('view_content', function($breadcrumbs, $content){
	$breadcrumbs->parent('content');
	$breadcrumbs->push('View Content Page', route('admin.content.show', $content->id));
});

//Content Page Show
Breadcrumbs::register('reload', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Realod Data', route('admin.reload.index'));
});

//Content Page Show
Breadcrumbs::register('group_reload', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Group Realod Data', route('admin.group-reload.index'));
});

// Number Listing
Breadcrumbs::register('press', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Press', route('admin.presses.index'));
});

// press Add
Breadcrumbs::register('add_press', function($breadcrumbs){
	$breadcrumbs->parent('press');
	$breadcrumbs->push('Add Press', route('admin.presses.create'));
});

// press Edit
Breadcrumbs::register('edit_press', function($breadcrumbs, $press){
	$breadcrumbs->parent('press');
	$breadcrumbs->push('Edit Press', route('admin.presses.edit', $press->id));
});

// press Show
Breadcrumbs::register('view_press', function($breadcrumbs, $press){
	$breadcrumbs->parent('press');
	$breadcrumbs->push('View Press', route('admin.presses.show', $press->id));
});

// Coupon Listing
Breadcrumbs::register('coupon', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
	$breadcrumbs->push('Coupon', route('admin.coupons.index'));
});

// Coupon Add
Breadcrumbs::register('add_coupon', function($breadcrumbs){
	$breadcrumbs->parent('coupon');
	$breadcrumbs->push('Add Coupon', route('admin.coupons.create'));
});

// Coupon Edit
Breadcrumbs::register('edit_coupon', function($breadcrumbs, $coupon){
	$breadcrumbs->parent('coupon');
	$breadcrumbs->push('Edit coupon', route('admin.coupons.edit', $coupon->id));
});