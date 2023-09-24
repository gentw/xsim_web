@extends('layouts.app')

@section('banner')
<section class="banner online-store"></section>
@endsection

@section('content')
<main>
    <section class="login-register-section paddingt-none online-store-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                	<h1 class="yellow titleh3">ONLINE SHOP</h1>
                	@if(!$set_reload_amount)
	                    <div class="shadow-box form-step step1">
	                        <ul class="row list">
	                        	<li class="step-name col-sm-10 col-xs-9">You Wish</li>
	                        	<li class="text-right step-num col-sm-2 col-xs-3">01</li>
	                        </ul>
	                        <hr>
	                       	<div class="row check-list">
	                       		<div class="col-sm-4">
	                       			<label for="buy">Buy XXSIM Card</label>
	                       			<input type="checkbox" name="type" id="buy" value="buy" @if($select_type == 'buy') checked @endif />
	                       		</div>
	                       		<div class="col-sm-5">
	                       			<label for="recharge">Recharge your XXSIM Card</label>
	                       			<input type="checkbox" name="type" id="recharge" value="recharge" @if($select_type == 'recharge') checked @endif />
	                       		</div>
	                       		<div class="col-sm-3 text-right">
	                       			<button type="button" data-next="step2" id="btn-step1" class="rounded-btn btn-next">Next</button>
	                       		</div>
	                       	</div>
	                    </div>
	                    <div class="shadow-box form-step step2 hide"> <!-- hide -->
	                        <ul class="row list">
	                        	<li class="step-name col-sm-10 col-xs-9">Your XXSIM Card</li>
	                        	<li class="text-right step-num col-sm-2 col-xs-3">02</li>
	                        </ul>
	                        <hr>
	                        <h2 class="titleh5">Format</h2>
	                       	<div class="row buy-section">
	                       		<div class="col-md-6 col-lg-3">
	                       			<div data-sim="regular" class="select-sim text-center">
	                       				<div class="data">
	                       					<img alt="sim" src="{{ asset('front/images/blue-sim.png') }}">
	                       					<h2 class="titleh4">XXSIM</h2>
	                       				</div>
	                       				<div class="data-after">
	                       					<div class="inner">
	                       						<i class="fa fa-check"></i>
	                       						<p>XX SIM <br>selected</p>
	                       					</div>
	                       				</div>
	                       			</div>
	                       			<div class="form-group">
	                                    <input type="number" min="0" class="form-control qty-sim" name="qty-regular" id="qty-regular" placeholder="Quantity">
	                                </div>
	                       		</div>
	                       		<div class="col-md-6 col-lg-3">
	                       			&nbsp;
	                       		</div>
	                       		<div class="col-md-6 col-lg-3">
	                       			&nbsp;
	                       		</div>
	                       		
	                       		<div class="col-md-6 col-lg-3">
	                       			<div class="total">
	                       				<h2 class="titleh4">Total</h2>
	                       				<h3>&euro; <span id="sim-amount">0</span></h3>
	                       			</div>
	                       			<div class="form-group mobile-center">
	                                    <button type="button" data-next="step3" id="btn-step2" class="rounded-btn btn-next">Next</button>
	                                </div>
	                       		</div>
	                       	</div>
	                       	<div class="row reload-section">
	                       		<form action="javascript:;" id="frmRelaod">
		                       		<div class="col-sm-4">
		                       			<div class="form-group">
		                       				<label>XXSIM#</label>
		                       				<div class="input-group">
											  <span class="input-group-addon" id="basic-addon3">+</span>
											  <input type="text" name="card_number" id="card_number" data-error-container="#error-card-number" placeholder="372xxxxxxxx" class="form-control" aria-describedby="basic-addon3">
											</div>
		                       				<span id="error-card-number"></span>
		                       			</div>
		                       		</div>
		                       		<div class="col-sm-4">
		                       			<div class="form-group">
		                       				<label>Confirm XXSIM#</label>
		                       				<div class="input-group">
											  <span class="input-group-addon" id="basic-addon4">+</span>
											  <input type="text" name="card_number_confirm" data-error-container="#error-card-number-confirm" placeholder="372xxxxxxxx" class="form-control" aria-describedby="basic-addon4">
											</div>
		                       				<span id="error-card-number-confirm"></span>
		                       			</div>
		                       		</div>
		                       		<div class="col-sm-4">
		                       			<div class="form-group">
		                       				<label>Reload Amount &euro;</label>
		                       				<select name="reload_prices" id="reload-prices" data-error-container="#error-reload-prices" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
		                       					<option value="">Select Amount</option>
		                       					<option value="10">10</option>
		                       					<option value="20">20</option>
		                       					<option value="50">50</option>
				                                <option value="100">100</option>
				               					<option value="200">200</option>
				               					<option value="500">500</option>
		                       				</select>
		                       				<span id="error-reload-prices"></span>
		                       			</div>
		                       		</div>
		                       		<div class="step-2-bottom">
			                       		<div class="col-sm-4">
			                       			<div class="captcha">
			                       				<img src="{{ env('APP_URL') . '/generate_captcha.php' }}" id="img-captcha" alt="captcha">
			                       				<a href="javascript:void(0);" class="captcha-reload" id="refresh-captcha"><i class="fa fa-refresh"></i></a>
			                       			</div>
			                       		</div>
			                       		<div class="col-sm-4">
			                       			<div class="form-group">
			                       				<label>Security Code</label>
			                       				<input type="text" name="captcha" id="captcha" autocomplete="off" class="form-control">
			                       			</div>
			                       		</div>
			                       		<div class="col-sm-4">
			                       			<div class="form-group reload-btn-block">
		                                        <button type="submit" id="btn-reload" class="rounded-btn theme-btn big-btn">Reload</button>
		                                    </div>
			                       		</div>
			                       	</div>
		                       		<div class="col-sm-12">
		                       			<div class="total">
		                       				<h4>Total</h4>
		                       				<h3>&euro; <span id="reload-amount">0</span></h3>
		                       			</div>
		                       		</div>
	                       		</form>
	                       	</div>
	                    </div>
	                	<div class="shadow-box form-step step3 hide"> <!-- hide -->
	                		<ul class="row list">
	                        	<li class="step-name col-sm-10 col-xs-9">My Profile</li>
	                        	<li class="text-right step-num col-sm-2 col-xs-3">03</li>
	                        </ul>
	                        <hr>
	                        @if(Auth::guest())
		                        <div class="row check-list">
		                       		<div class="col-sm-5">
		                       			<label for="chk1">Are you a new customer</label>
		                       			<input type="checkbox" name="user_type" id="new_user" value="new_user" @if(Auth::guest()) checked @else disabled @endif />
		                       		</div>
		                       		<div class="col-sm-5">
		                       			<label for="chk2">I already have an account</label>
		                       			<input type="checkbox" name="user_type" id="old_user" value="old_user" @if(!Auth::guest()) checked disabled @endif />
		                       		</div>
		                       		<div class="col-sm-2 "></div>
		                       	</div>
								<hr class="second-break">
								<div class="new-account-form">
									<form action="javascript:;" id="frmRegister">
										<div class="row">
											<div class="col-sm-6">
												<select name="title" id="title" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-title">
							                        <option value="" class="hideme">Title</option>
							                        <option value="Mr">Mr</option>
							                        <option value="Ms">Ms</option>
							                        <option value="Mrs">Mrs</option>
							                    </select>
							                    <span id="error-title"></span>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of birth">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="ZIP Code">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="city" id="city" class="form-control" placeholder="City">
			                                    </div>
											</div>
											<div class="col-sm-6">
		                                        <select class="custom" name="country" id="country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-country">
						                            <option value="" class="hideme">Country</option>
						                            @foreach($countries as $country)
						                                <option value="{{ $country->id_country }}">{{ $country->name }}</option>
						                            @endforeach
						                        </select>
						                        <span id="error-country"></span>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="email" name="email" id="email" class="form-control" placeholder="email">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <div class="input-group">
													  <span class="input-group-addon" id="basic-addon1">+</span>
													  <input type="text" name="phone" id="phone" class="form-control" data-error-container="#error-phone" placeholder="Your Landline Phone#" aria-describedby="basic-addon1">
													</div>
													<span id="error-phone"></span>
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="company" id="company" class="form-control" placeholder="Company">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group light">
													International format (not your XXSIM#) <br> Ex: +971501111111
												</div>
											</div>
											<div class="col-sm-6">
												<select name="document" id="document" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-document">
							                        <option value="" class="hideme">Type of Document</option>
							                        <option value="passport">Passport</option>
							                        <option value="id">ID</option>
							                    </select>
							                    <span id="error-document"></span>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="text" name="document_no" id="document_no" class="form-control" placeholder="Document #">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
			                                    </div>
											 </div>
										</div>
										<div class="row checkbox-area">
											<div class="col-sm-9">
												<div class="check-box">
													<label for="chk2"><a href="{{ route('general_sales') }}" target="_blank">General Conditions</a> of Sale</label>
				                       				<input type="checkbox" name="accept_terms" id="chk_terms" data-error-container="#error-accept-terms" />
				                       				<span id="error-accept-terms"></span>
												</div>
											</div>
											<div class="col-sm-3 text-right top-space">
												<button type="submit" data-next="step5" id="btn-step3" class="rounded-btn btn-next">Next</button>
											</div>
										</div>
									</form>
								</div>
								<div class="already-account-form">
									<form action="javascript:;" id="frmLogin">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="email" name="email" id="email" class="form-control" placeholder="email">
			                                    </div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
			                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
			                                    </div>
											</div>
										</div>
										<p><a href="{{ route('password.request') }}">You forgot your password ?</a></p>
										<button type="submit" id="btn-login" class="theme-btn">Submit</button>
									</form>
								</div>
	                        @else
								<div>
									<label>Name : </label>
									<label>{{ Auth::user()->contact->firstname . ' ' . Auth::user()->contact->lastname }}</label>
								</div>
								<div>
									<label>Email : </label>
									<label>{{ Auth::user()->contact->email }}</label>
								</div>
								<div class="text-right top-space">
									<button type="button" data-next="step5" id="btn-step3" class="rounded-btn btn-next">Next</button>
								</div>
							@endif
	                    </div>
	                @endif
                    <div class="shadow-box form-step step5 @if(!$set_reload_amount) hide @endif"> <!-- hide -->
                    	<ul class="row list">
                        	<li class="step-name col-sm-10 col-xs-9">Order Information</li>
                        	<li class="text-right step-num col-sm-2 col-xs-3">04</li>
                        </ul>
                        <div class="order-list-container">
                        	<div class="order-list-head">
                        		Orders
                        	</div>
                        	<div class="order-list-body">
								<ul class="list-unstyled">
									@if($set_reload_amount)
										<li>
											<div class="row">
												<div class="col-sm-8 col-xs-7">
													Reload a card
												</div>
												<div class="col-sm-2 col-xs-2">
													1
												</div>
												<div class="col-sm-2 col-xs-3 price">
													&euro; {{ $reload_amount }}
												</div>
											</div>
										</li>
									@endif
								</ul>
                        	</div>
                        	<div class="order-list-footer">
                        		<div class="row">
                					<div class="col-sm-10 col-xs-7">
                						Total
                					</div>
                					<div class="col-sm-2 col-xs-5 price">
                						&euro; <span id="total_amount">{{ !empty($reload_amount) ? $reload_amount : 0 }} </span>
                					</div>
                				</div>
                        	</div>
                        </div>
                        <div class="top-space">
                				<button type="button" data-next="step6" id="btn-step6" class="rounded-btn btn-next big-btn">Confirm</button>
                		</div>
                    </div>
                    <div class="shadow-box form-step step6 hide"> <!-- hide -->
                        <ul class="row list">
                        	<li class="step-name col-sm-10 col-xs-9">Payment</li>
                        	<li class="text-right step-num col-sm-2 col-xs-3">05</li>
                        </ul>

                		<div id="credit-card" class="tab-pane credit-card fade in active">
					    	<!-- <h3>Enter Credit Card Information</h3> -->
					    	<form action="javascript:;" id="frmCardPayment" role="form" class="form-inline">
					    		<div class="form-group">
					    			<label>Cardholder Name</label>
					    			<input type="text" name="cardholder_name" class="form-control" placeholder="Your Name">
					    		</div>
					    		<div class="form-group card-number">
					    			<label>Card Number</label>
					    			<input type="text" name="card_number" class="form-control" placeholder="1234 5678 3456 2456"> <!-- 4758411877817150 -->
					    			<span id="card_type"></span>
					    			<!-- <img src="{{ asset('front/images/visa.png') }}" alt="visa"> -->
					    		</div>
					    		<div class="form-group expire">
					    			<label>Expire Date</label>
					    			<input type="text" name="expire" class="form-control" placeholder="05/21">
					    		</div>
					    		<div class="form-group cvv">
					    			<label>Cvv</label>
					    			<input type="text" name="cvv" class="form-control" maxlength="3" placeholder="123">
					    		</div>
					    		<div class="form-group">
					    			<div class="checkbox">
									    <label><input type="checkbox" name="accept_terms" data-error-container="#error-accept-terms">I agree to XXSIM terms & conditions</label>
									    <span id="error-accept-terms"></span>
									</div>
					    		</div>
						    	<div class="top-space">
		            				<button type="submit" class="rounded-btn big-btn">Finish</button>
		            		  	</div>
		            		</form>
					    </div>
                    </div>

<!-- Online Content Start-->
<div class="shadow-box form-step">
<div class="tab-pane credit-card fade in active">
<p style="color: #494864;">When traveling abroad, you need an international SIM card to stay in touch with family and friends. With XXSIM, forget all your international roaming woes and enjoy the best call rates. To make this process simpler for you, we offer an easy online availability of our SIM card. All you need to do is register your profile, give your passport or ID details, and make online payments through a debit/credit card. It's that easy and safe!</p>
<p style="color: #494864;">We offer free worldwide delivery and a secure portal to keep your information protected. Once you register for online shopping with us, you can enjoy a seamless overview of your account anytime from anywhere. </p>
<p style="color: #494864;">So, why wait, choose your SIM card, and place an order right away!</p>
</div>
</div>
<!-- Online Content End-->

                </div>
                <div class="col-md-4">
                	<h2 class="text-right mobile-center">WORKING HOURS</h2>
                	<div class="help-block shadow-box">
                		<h3>Help</h3>
                		<p>XXSIM without complications and commitments!</p>
						<p class="marginb-none">In order to receive your XXSIM, please:</p>
						<ul>
							<li>- register your profile</li>
							<li>- enter your passport# or ID#</li>
							<li>- pay instantly by credit card or through PayPal</li>
						</ul>
                	</div>
                    <div class="contact-you-block shadow-box">
                        <h4>Do you want our <br />sales to contact you?</h4>
                        <p>We will contact you within the next 24h</p>
                        <form action="javascript:;" id="contact-phone">
	                        <div class="submit-box">
	                        	<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1">+</span>
								  <input type="text" name="phone" placeholder="1234567890" aria-describedby="basic-addon1">
								</div>
	                            <button type="submit">submit</button>
	                        </div>
	                    </form>
                        <h4>Do you want our <br />sales to contact you through email?</h4>
                        <p>We will contact you within the next 24h</p>
                        <form action="javascript:;" id="contact-email">
	                        <div class="submit-box">
	                            <input name="email" type="text" placeholder="email">
	                            <button type="submit">submit</button>
	                        </div>
                        </form>
                    </div>
                </div>
                <form id="shoping-form" action="{{ route('make_payment') }}" method="post">
                	{{ csrf_field() }}
		    		<input type="hidden" name="qty_regular">
		    		<input type="hidden" name="reload_amount">
		    		<input type="hidden" name="reload_number">
		    		<input type="hidden" name="cardholder_name">
		    		<input type="hidden" name="card_number">
		    		<input type="hidden" name="exp_month">
		    		<input type="hidden" name="exp_year">
		    		<input type="hidden" name="cvv">
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">
		$(function(){

			$('#refresh-captcha').click(function(){
				$(this).blur();
				$("#img-captcha").attr('src', "{{ env('APP_URL') . '/generate_captcha.php'  }}");
			});

			window.addEventListener( "pageshow", function ( event ) {
				var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
				if (historyTraversal) {
					window.location.reload();
				}
			});

			@if(!$set_reload_amount)
				/**
				 * Next button action
				 */
				$(".btn-next").click(function(){
					if($(this).data('next') == 'step3'){
						if($("#sim-amount").html() == '0'){
							showMessage(204, 'Please enter quantity of at least one SIM type.');
						}
						else{
							$('.' + $(this).data('next')).removeClass('hide');
							$('html, body').animate({
								scrollTop: $('.'+$(this).data('next')).offset().top
							}, 'slow');
						}
					}
					else if($(this).data('next') == 'step5'){
						if("{{Auth::guest()}}"){
							if($('#frmRegister').valid()){
								var data = $('#frmRegister').serialize();
								var next_element = $(this).data('next');
								check_register(data, function(r){
									if(r.status == 200){
										$('#frmRegister input, #frmRegister select, .check-list input, #btn-step3').attr('disabled', 'disabled');
										set_order_info();
										$('.' + next_element).removeClass('hide');
										$('html, body').animate({
											scrollTop: $('.'+next_element).offset().top
										}, 'slow');
				                    }
				                    else{
				                        showMessage(r.status,r.message);
				                    }
								});
								return true;
							}
							else{
								return false;
							}
						}
						else{
							set_order_info();
							$('.' + $(this).data('next')).removeClass('hide');
							$('html, body').animate({
								scrollTop: $('.'+$(this).data('next')).offset().top
							}, 'slow');
						}
					}
					else {
						$('.' + $(this).data('next')).removeClass('hide');
						$('html, body').animate({
							scrollTop: $('.'+$(this).data('next')).offset().top
						}, 'slow');
					}
				});

				/**
				 * Step - 1 Varifications and scripts
				 */
				$("#buy").change(function(){
					if($('#recharge').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#recharge").trigger('click');
					}
					else if($('#buy').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#buy").trigger('click');
					}
				});

				$("#recharge").change(function(){
					if($('#buy').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#buy").trigger('click');
					}
					else if($('#recharge').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#recharge").trigger('click');
					}
				});

				$('#btn-step1').click(function(){
					var type = $('.jcf-checked').children('input[name="type"]').val();
					if(type == 'buy'){
						$('.reload-section').hide();
						$('.buy-section').show();
						$('#frmRelaod').get(0).reset();
						$('.step3 , .step5 , .step6').addClass('hide');
					}
					else{
						$('.buy-section').hide();
						$('.step3 , .step5 , .step6').addClass('hide');
						$('.reload-section').show();
						$('#qty-regular').val('');
			            $('#qty-micro').val('');
			            $('#qty-nano').val('');
					}
				});

				$(".qty-sim").change(function(){
					var regular_sim = $('#qty-regular').val() != '' ? $('#qty-regular').val() : 0;

					if(regular_sim < 0){
						showMessage(212, "please enter minimum 1 quantity for regular SIM");
						$('#qty-regular').val('');
					}

					if(regular_sim >= 0 || micro_sim >=0 || nano_sim >= 0){
						$("#sim-amount").html((parseInt(regular_sim)) * 12);
					}
				});

				/**
				 * Step - 2 Reload section varifications and scripts
				 */

				$("#reload-prices").change(function(){
					$("#reload-amount").html(($(this).val() != '' ? $(this).val() : 0));
				});

				$("#btn-reload").click(function(){
					if($("#frmRelaod").valid()){
						check_captcha($('#frmRelaod').serialize(), function(r){
							$("#img-captcha").attr('src', "{{ env('APP_URL') . '/generate_captcha.php'  }}");
							if(r.status == 200){
		                        var data = {'api_name' : 'get_balance', 'card': $("#frmRelaod #card_number").val()};
				                call_api(data, function(r){
				                    if(r.status == 200){
				                    	$(".order-list-body ul").html('');
				                    	var r_value = $('#reload-prices').val();
				                    	if(r_value != ''){
											$(".order-list-body ul").append(`<li>
															<div class="row">
																<div class="col-sm-8 col-xs-7">
																Reload a card
																</div>
																<div class="col-sm-2 col-xs-2">
																	`+1+`
																</div>
																<div class="col-sm-2 col-xs-3 price">
																	&euro; `+ r_value +`
																</div>
															</div>
														</li>`);
											$('#total_amount').html($('#reload-amount').html());
										}
				                        $('.step5').removeClass('hide');
				                        $('html, body').animate({
											scrollTop: $('.step5').offset().top
										}, 'slow');
				                    }
				                    else{
				                        showMessage(r.status,r.message);
				                    }
				                });
		                    }
		                    else{
		                        showMessage(r.status,r.message);
		                    }
						});
						return true;
					}
					else{
						return false;
					}
				});

				$("#frmRelaod").validate({
					errorClass: 'help-block',
			        errorElement: 'span',
			        rules: {
			            card_number:{
			                required: true,
			                digits: true,
			                minlength: 5,
			                maxlength: 15,
			                min: 1,
			            },
			            card_number_confirm:{
			                required: true,
			                digits: true,
			                minlength: 5,
			                maxlength: 15,
			                min: 1,
			                equalTo: '#card_number',
			            },
			            reload_prices:{
			            	required: true,
			            },
			            captcha:{
			            	required: true,
			            }
			        },
			        messages: {
			            card_number:{
			                required:"@lang('validation.required',['attribute'=>'card number'])",
			                digits: "@lang('validation.numeric', ['attribute'=>'card number'])",
			                minlength: "@lang('validation.min.string', ['attribute'=>'card number', 'min'=>5])",
			                maxlength: "@lang('validation.max.string', ['attribute'=>'card number', 'max'=>15])",
			                min: "@lang('validation.min.numeric', ['attribute'=>'card number', 'min'=>1])",
			            },
			            card_number_confirm:{
			                required:"@lang('validation.required',['attribute'=>'card number'])",
			                digits: "@lang('validation.numeric', ['attribute'=>'card number'])",
			                minlength: "@lang('validation.min.string', ['attribute'=>'card number', 'min'=>5])",
			                maxlength: "@lang('validation.max.string', ['attribute'=>'card number', 'max'=>15])",
			                min: "@lang('validation.min.numeric', ['attribute'=>'card number', 'min'=>1])",
			                equalTo:"@lang('validation.same', ['attribute'=>'card number', 'other'=>'card number'])"
			            },
			            reload_prices:{
			            	required:"@lang('validation.required',['attribute'=>'reload amount'])",
			            },
			            captcha:{
			            	required:"@lang('validation.required',['attribute'=>'security code'])",
			            }
			        },
			        invalidHandler: function (event, validator) { //display error alert on form submit
		                $('.alert-danger', $('#frmRelaod')).show();
		                $('#frmRelaod').addClass('form-error');
		            },
			        highlight: function (element) {
			        	$('#frmRelaod').addClass('form-error');
			           $(element).closest('.form-group').addClass('has-error');
			        },
			        unhighlight: function (element) {
			           $(element).closest('.form-group').removeClass('has-error');
			        },
			        errorPlacement: function (error, element) {
		                if (element.attr("data-error-container")) {
		                    error.appendTo(element.attr("data-error-container"));
		                } else {
		                    error.insertAfter(element);
		                }
			        }
			    });

				/**
				 * Step - 3 verifications and scripts
				 */
				$('.already-account-form').hide();

				$("#new_user").change(function(){
					if($('#old_user').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#old_user").trigger('click');
					}
					else if($('#new_user').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#new_user").trigger('click');
					}
				});

				$("#old_user").change(function(){
					if($('#new_user').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#new_user").trigger('click');
					}
					else if($('#old_user').closest('.jcf-checkbox').hasClass('jcf-checked')){
						$("#old_user").trigger('click');
					}
				});

				$('input[name="user_type"]').change(function(){
					var type = $(this).val();
					if(type == 'new_user'){
						$('.already-account-form').hide();
						$('.new-account-form').show();
					}
					else{
						$('.new-account-form').hide();
						$('.already-account-form').show();
					}
				});

				/**
				 * Step - 3 Login section varification and scripts
				 */
				$('#frmLogin').validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            rules: {
		                email: {
		                    required: true,
		                    valid_email: true
		                },
		                password: {
		                    required: true,
		                    minlength:6,
		                    no_space: true
		                }
		            },

		            messages: {
		                email: {
		                    required: "@lang('validation.required', ['attribute'=>'email'])",
		                    email:"@lang('validation.email', ['attribute'=>'email'])"
		                },
		                password: {
		                    required: "@lang('validation.required', ['attribute'=>'password'])",
		                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
		                }
		            },

		            invalidHandler: function (event, validator) { //display error alert on form submit
		                $('.alert-danger', $('#frmLogin')).show();
		                $('#frmLogin').addClass('form-error');
		            },

		            highlight: function (element) { // hightlight error inputs
		            	$('#frmLogin').addClass('form-error');
		                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
		            },
		            success: function (label) {
		                label.closest('.form-group').removeClass('has-error');
		                label.remove();
		            },

		            errorPlacement: function (error, element) {
		                error.insertAfter(element);
		            },
		        });

				$("#btn-login").click(function(){
					if($('#frmLogin').valid()){
						var data = {'email' : $("#frmLogin #email").val(), 'password' : $('#frmLogin #password').val()};
						check_login(data, function(r){
							if(r.status == 200){
								set_order_info();
		                        $('.step5').removeClass('hide');
		                        $('#frmLogin input, .check-list input, #btn-login').attr('disabled', 'disabled');
		                        $('html, body').animate({
									scrollTop: $('.step5').offset().top
								}, 'slow');
		                    }
		                    else{
		                        showMessage(r.status,r.message);
		                    }
						});
						return true;
					}
					else{
						return false;
					}
				});

				/**
				 * Step - 3 Register section varification ansd scripts
				 */
				var today = new Date();
		        var today = today.getFullYear() + '-' + ("0" + (today.getMonth()+1)).slice(-2) + '-' + ("0" + today.getDate()).slice(-2);
		        $('#frmRegister #dob').datetextentry({
		            field_order : 'DMY',
		            separator : '/',
		            E_MAX_DATE : 'Date must not be later than ' + today,
		            max_date : today,
		            show_tooltips: false,
		        });

				$('#frmRegister').validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            rules: {
		                title: {
		                    required: true,
		                },
		                address: {
		                    required: true,
		                    not_empty: true,
		                },
		                name: {
		                    required: true,
		                    not_empty: true,
		                },
		                /*zip_code: {
		                    required: true,
		                    not_empty: true,
		                    digits: true,
		                },*/
		                surname: {
		                    required: true,
		                    not_empty: true,
		                },
		                city: {
		                    required: true,
		                    not_empty: true,
		                },
		                dob: {
		                    required: true,
		                },
		                country: {
		                    required: true,
		                },
		                currency: {
		                    required: true,
		                },
		                document: {
		                    required: true,
		                },
		                document_no: {
		                    required: true,
		                    not_empty: true,
		                },
		                phone: {
		                    required: true,
		                    digits: true,
		                    minlength: 5,
		                    maxlength: 15
		                },
		                mobile: {
		                    required: true,
		                    digits: true,
		                    minlength: 5,
		                    maxlength: 15
		                },
		                /*company: {
		                    required: true,
		                    not_empty: true,
		                },*/
		                email: {
		                    required: true,
		                    valid_email: true,
		                    remote: {
		                        url: "{{ route('uniqueemail') }}",
		                        type: "post",
		                        data: {
		                            _token: function() {
		                                return "{{csrf_token()}}"
		                            },
		                            email: function(){
		                                return $("#email").val();
		                            }
		                        }
		                    },
		                },
		                password: {
		                    required: true,
		                    minlength:6,
		                    no_space: true
		                },
		                password_confirmation:{
		                    required:true,
		                    minlength:6,
		                    no_space:true,
		                    equalTo:"#password"
		                },
		                accept_email: {
		                    required: true,
		                },
		                accept_terms: {
		                    required: true,
		                },
		            },

		            messages: {
		                title: {
		                    required: "@lang('validation.required', ['attribute'=>'title'])",
		                },
		                address: {
		                    required: "@lang('validation.required', ['attribute'=>'address'])",
		                },
		                name: {
		                    required: "@lang('validation.required', ['attribute'=>'name'])",
		                },
		                /*zip_code: {
		                    required: "@lang('validation.required', ['attribute'=>'zip code'])",
		                    digits: "@lang('validation.numeric', ['attribute'=>'zip code'])",
		                },*/
		                surname: {
		                    required: "@lang('validation.required', ['attribute'=>'surname'])",
		                },
		                city: {
		                    required: "@lang('validation.required', ['attribute'=>'city'])",
		                },
		                dob: {
		                    required: "@lang('validation.required', ['attribute'=>'date of birth'])",
		                },
		                country: {
		                    required: "@lang('validation.required', ['attribute'=>'country'])",
		                },
		                currency: {
		                    required: "@lang('validation.required', ['attribute'=>'currency'])",
		                },
		                document: {
		                    required: "@lang('validation.required', ['attribute'=>'document'])",
		                },
		                document_no: {
		                    required: "@lang('validation.required', ['attribute'=>'document number'])",
		                },
		                phone: {
		                    required: "@lang('validation.required', ['attribute'=>'phone'])",
		                    digits: "@lang('validation.numeric', ['attribute'=>'phone'])",
		                    minlength: "@lang('validation.min.string', ['attribute'=>'phone', 'min'=>5])",
		                    maxlength: "@lang('validation.max.string', ['attribute'=>'phone', 'max'=>15])"
		                },
		                mobile: {
		                    required: "@lang('validation.required', ['attribute'=>'mobile'])",
		                    digits: "@lang('validation.numeric', ['attribute'=>'mobile'])",
		                    minlength: "@lang('validation.min.string', ['attribute'=>'mobile', 'min'=>5])",
		                    maxlength: "@lang('validation.max.string', ['attribute'=>'mobile', 'max'=>15])"
		                },
		                /*company: {
		                    required: "@lang('validation.required', ['attribute'=>'company'])",
		                },*/
		                email: {
		                    required: "@lang('validation.required', ['attribute'=>'email'])",
		                    email:"@lang('validation.email', ['attribute'=>'email'])",
		                    remote:"@lang('validation.unique',['attribute'=>'email'])",
		                },
		                password: {
		                    required: "@lang('validation.required', ['attribute'=>'password'])",
		                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
		                },
		                password_confirmation:{
		                    required:"@lang('validation.required', ['attribute'=>'confirm password'])",
		                    minlength: "@lang('validation.min.string', ['attribute'=>'confirm password', 'min'=>6])",
		                    equalTo:"@lang('validation.same', ['attribute'=>'confirm password', 'other'=>'password'])"
		                },
		                accept_email: {
		                    required: "@lang('validation.accepted', ['attribute'=>'periodic emails'])",
		                },
		                accept_terms: {
		                    required: "@lang('validation.accepted', ['attribute'=>'general conditions'])",
		                },
		            },

		            invalidHandler: function (event, validator) { //display error alert on form submit
		                $('.alert-danger', $('#frmRegister')).show();
		                $('#frmRegister').addClass('form-error');
		            },

		            highlight: function (element) { // hightlight error inputs
		            	$('#frmRegister').addClass('form-error');
		                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
		            },
		            success: function (label) {
		                label.closest('.form-group').removeClass('has-error');
		                label.remove();
		            },

		            errorPlacement: function (error, element) {
		                if (element.attr("data-error-container")) {
		                    error.appendTo(element.attr("data-error-container"));
		                } else {
		                    error.insertAfter(element);
		                }
		            },

		            submitHandler: function (form) {
		                $('#frmRegister').removeClass('form-error');
		                form.submit();
		            }
		        });
			@else
				$(".btn-next").click(function(){
					$('.' + $(this).data('next')).removeClass('hide');
					$('html, body').animate({
						scrollTop: $('.'+$(this).data('next')).offset().top
					}, 'slow');
				});
			@endif

			/**
			 * Step - 6 Card Payment
			 */
			$.validator.addMethod('expiry_date', function(value, element){
				var exp = value.split('/');
				if($.isArray(exp) && exp.length == 2){
					var d = new Date(), month = d.getMonth(),year = d.getFullYear().toString().substr(-2);
					console.log("c_m " + month);
					console.log("c_y " + year);
					console.log("m " + exp[0]);
					console.log("y " + exp[1]);
					if(parseInt(exp[1]) < parseInt(year)){
						return false;
					}
					else if(parseInt(exp[1]) == parseInt(year) && parseInt(exp[0]) <= (parseInt(month)+1)) {
						return false;
					}
					else{
						return true;
					}
				}
				else{
					return false;
				}
			}, "Please enter a valid expiry date.");

			$("#frmCardPayment").validate({
				errorClass: 'help-block',
		        errorElement: 'span',
		        rules: {
		            cardholder_name:{
		                required: true,
		            },
		            card_number:{
		                required: true,
		                digits: true,
		                minlength: 16,
		                maxlength: 19,
		                min: 1,
		            },
		            expire:{
		            	required: true,
		            	expiry_date: true
		            },
		            cvv:{
		            	required: true,
		            	digits: true,
		                minlength: 3,
		                maxlength: 3,
		                min: 1,
		            },
		            accept_terms: {
	                    required: true,
	                },
		        },
		        messages: {
		            card_number:{
		                required:"@lang('validation.required',['attribute'=>'card number'])",
		                digits: "@lang('validation.numeric', ['attribute'=>'card number'])",
		                minlength: "@lang('validation.min.string', ['attribute'=>'card number', 'min'=>16])",
		                maxlength: "@lang('validation.max.string', ['attribute'=>'card number', 'max'=>19])",
		                min: "@lang('validation.min.numeric', ['attribute'=>'card number', 'min'=>1])",
		            },
		            cardholder_name:{
		                required:"@lang('validation.required',['attribute'=>'card holder name'])",
		            },
		            expire:{
		            	required:"@lang('validation.required',['attribute'=>'expire'])",
		            },
		            cvv:{
		            	required:"@lang('validation.required',['attribute'=>'cvv'])",
		                digits: "@lang('validation.numeric', ['attribute'=>'cvv'])",
		                minlength: "@lang('validation.min.string', ['attribute'=>'cvv', 'min'=>3])",
		                maxlength: "@lang('validation.max.string', ['attribute'=>'cvv', 'max'=>3])",
		                min: "@lang('validation.min.numeric', ['attribute'=>'cvv', 'min'=>1])",
		            },
		            accept_terms: {
	                    required: "@lang('validation.accepted', ['attribute'=>'general conditions'])",
	                },
		        },
		        invalidHandler: function (event, validator) { //display error alert on form submit
	                $('.alert-danger', $('#frmCardPayment')).show();
	                $('#frmCardPayment').addClass('form-error');
	            },
		        highlight: function (element) {
		        	$('#frmCardPayment').addClass('form-error');
		           $(element).closest('.form-group').addClass('has-error');
		        },
		        unhighlight: function (element) {
		           $(element).closest('.form-group').removeClass('has-error');
		        },
		        errorPlacement: function (error, element) {
	                if (element.attr("data-error-container")) {
	                    error.appendTo(element.attr("data-error-container"));
	                } else {
	                    error.insertAfter(element);
	                }
		        }
		    });

			$("#frmCardPayment input[name='card_number']").change(function(){
				$('#card_type').html(get_card_type($(this).val()));
			});

			$('#frmCardPayment').submit(function(){
				if($(this).valid()){
					var cards = $('#qty-regular').val();
					var reload_amount = @if(!$set_reload_amount) $('#reload-prices').val() @else "{{ $reload_amount }}" @endif;
					var reload_number = @if(!$set_reload_amount) $('#frmRelaod input[name="card_number"]').val() @else "{{ $reload_number }}" @endif;

					if((cards == '' || cards == null || cards == undefined) && (reload_amount == '' || reload_amount == null || reload_amount == undefined || reload_number == '' || reload_number == null || reload_number == undefined)){
						showMessage(412, "Something went wrong! Please try again later");
						return false;
					}
					else{
						var expire = $('#frmCardPayment input[name="expire"]').val().split('/');
						$('#shoping-form input[name="qty_regular"]').val(cards);
						$('#shoping-form input[name="reload_amount"]').val(reload_amount);
						$('#shoping-form input[name="reload_number"]').val(reload_number);
						$('#shoping-form input[name="cardholder_name"]').val($('#frmCardPayment input[name="cardholder_name"]').val());
						$('#shoping-form input[name="card_number"]').val($('#frmCardPayment input[name="card_number"]').val());
						$('#shoping-form input[name="exp_month"]').val(expire[0]);
						$('#shoping-form input[name="exp_year"]').val(expire[1]);
						$('#shoping-form input[name="cvv"]').val($('#frmCardPayment input[name="cvv"]').val());
						$('#shoping-form').submit();
						addOverlay();
					}

				}
			})

			$('#contact-email').submit(function(){
		        var email = $('#contact-email input[name="email"]').val();
		        if(email != ''){
		            if(isEmail(email)){
		                var action = "{{ route('contact-email') }}";
		                $.ajax({
		                    url: action,
		                    type: 'POST',
		                    dataType: 'json',
		                    beforeSend: addOverlay,
		                    data: {
		                        _token: $('meta[name="csrf_token"]').attr('content'),
		                        email: email
		                    },
		                    success: function(r){
		                        showMessage(r.status, r.message);
		                    },
		                    complete: removeOverlay
		                });
		            }
		            else{
		                showMessage(212, "Please enter a valid email address.");
		            }
		        }
		        else{
		            showMessage(212, "The email address field is required");
		        }
		    });

		    $('#contact-phone').submit(function(){
		        var phone = $('#contact-phone input[name="phone"]').val();
		        if(phone != ''){
		            if(isPhone(phone)){
		                var action = "{{ route('contact-phone') }}";
		                $.ajax({
		                    url: action,
		                    type: 'POST',
		                    dataType: 'json',
		                    beforeSend: addOverlay,
		                    data: {
		                        _token: $('meta[name="csrf_token"]').attr('content'),
		                        phone: phone
		                    },
		                    success: function(r){
		                        showMessage(r.status, r.message);
		                    },
		                    complete: removeOverlay
		                });
		            }
		            else{
		                showMessage(412, "The enter a valid phone number.")    
		            }
		        }
		        else{
		            showMessage(412, "The phone number field is required.")
		        }
		    });

		    function isEmail(email) {
		        var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,})?$/;
		        return regex.test(email);
		    }

		    function isPhone(phone) {
		        var regex = /^\d+$/;
		        return regex.test(phone);
		    }

			/**
			 * Get credit card type
			 */
			function get_card_type(number) {
			    // visa
			    var re = new RegExp("^4");
			    if (number.match(re) != null)
			        return "Visa";

			    // Mastercard
			    // Updated for Mastercard 2017 BINs expansion
			     if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
			        return "Mastercard";

			    // AMEX
			    re = new RegExp("^3[47]");
			    if (number.match(re) != null)
			        return "AMEX";

			    // Discover
			    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
			    if (number.match(re) != null)
			        return "Discover";

			    // Diners
			    re = new RegExp("^36");
			    if (number.match(re) != null)
			        return "Diners";

			    // Diners - Carte Blanche
			    re = new RegExp("^30[0-5]");
			    if (number.match(re) != null)
			        return "Diners - Carte Blanche";

			    // JCB
			    re = new RegExp("^35(2[89]|[3-8][0-9])");
			    if (number.match(re) != null)
			        return "JCB";

			    // Visa Electron
			    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
			    if (number.match(re) != null)
			        return "Visa Electron";

			    return "";
			}

			function set_order_info() {
				$(".order-list-body ul ").html('');
				var regular_sim = $("#qty-regular").val();
				var micro_sim = $("#qty-micro").val();
				var nano_sim = $("#qty-nano").val();
				if(regular_sim != ''){
					$(".order-list-body ul ").append(`<li>
									<div class="row">
										<div class="col-sm-8 col-xs-7">
										Regular Sim
										</div>
										<div class="col-sm-2 col-xs-2">
											`+regular_sim+`
										</div>
										<div class="col-sm-2 col-xs-3 price">
											&euro; `+ (12 * parseInt(regular_sim)) +`
										</div>
									</div>
								</li>`);
				}
				$('#total_amount').html($('#sim-amount').html());
			}
		});
	</script>
@endpush
