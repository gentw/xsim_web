@extends('layouts.app')

@section('banner')
<section class="banner online-store"></section>
@endsection

@section('content')
<main>
    <section class="login-register-section paddingt-none online-store-sec group-reload">
        <div class="container">            
            <div class="row">
                <div class="col-md-12">
                	<h3 class="yellow">GROUP DEPOSIT</h3>
	                    <div class="shadow-box form-step step1"> 
	                        <ul class="row list">
	                        	<li class="step-name col-sm-10">Your XXSIM Card</li>
	                        	<li class="text-right step-num col-sm-2">01</li>
	                        </ul>   
	                        <hr>
	                       	<div class="row reload-section">
	                       		<form action="javascript:;" id="frmRelaod">
		                       		<div class="col-sm-4">
		                       			<div class="form-group">
		                       				<label>Group Name#</label>
		                       				<input type="text" name="group_name" id="group_name" placeholder="Group Name" class="form-control" value="{{ $group_name }}" readonly>
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
		                       				</select>
		                       				<span id="error-reload-prices"></span>
		                       			</div>
		                       		</div>
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
		                       			<div class="form-group ">
	                                        <button type="submit" id="btn-reload" class="rounded-btn theme-btn big-btn">Reload</button>
	                                    </div>
		                       		</div>
	                       		</form>
	                       	</div>
	                    </div>
                    <div class="shadow-box form-step step2 hide"> <!-- hide -->
                    	<ul class="row list">
                        	<li class="step-name col-sm-10">Order Information</li>
                        	<li class="text-right step-num col-sm-2">02</li>
                        </ul>
                        <div class="order-list-container">
                        	<div class="order-list-head">
                        		Orders
                        	</div>
                        	<div class="order-list-body">
								<ul class="list-unstyled">
								</ul>
                        	</div>
                        	<div class="order-list-footer">
                        		<div class="row">
                					<div class="col-sm-10 col-xs-7">
                						Total
                					</div>
                					<div class="col-sm-2 col-xs-5 price">
                						&euro; <span id="total_amount">0</span>
                					</div>
                				</div>
                        	</div>
                        </div>
                        <div class="top-space">
                			<button type="button" data-next="step3" id="btn-step2" class="rounded-btn btn-next big-btn">Confirm</button>
                		</div>
                    </div>
                    <div class="shadow-box form-step step3 hide"> <!-- hide -->
                        <ul class="row list">
                        	<li class="step-name col-sm-10">Payment</li>
                        	<li class="text-right step-num col-sm-2">03</li>
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
		            		  	<div class="paypal-payment">If you'd like to pay through Paypal, <a href="javascript:;" id="btn-paypal">Click here</a></div>
		            		</form>
					    </div>
                    </div>
                </div>
                <form id="shoping-form" action="{{ route('make_payment') }}" method="post">
                	{{ csrf_field() }}
		    		<input type="hidden" name="group_id" value="{{ $group_id }}">
		    		<input type="hidden" name="group_name" value="{{ $group_name }}">
		    		<input type="hidden" name="relaod_group_amount">
		    		<input type="hidden" name="cardholder_name">
		    		<input type="hidden" name="card_number">
		    		<input type="hidden" name="exp_month">
		    		<input type="hidden" name="exp_year">
		    		<input type="hidden" name="cvv">
                </form>
                <form action="{{ env('PAYPAL_URL') }}" method="post" id="paypal_payment_form">
                    <input type="hidden" name="business" value="{{ ENV('PAYPAL_BUSINESS') }}" >
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="item_name" id="paypal_item_name" value="">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="amount" id="paypal_item_amount" value="">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="cancel_return" value="{{ route('paypal_payment_fail') }}">
                    <input type="hidden" name="return" value="{{ route('paypal_payment_success') }}">
                    <input type="hidden" name="notify_url" value="{{ route('paypal_payment_notify') }}">
                    <input type='hidden' name='rm' value='2'>
                    <input type='hidden' name='custom' id="paypal_item_id" value=''/>
                </form>
            </div>            
        </div>
    </section>
</main>
@endsection

@push('scripts')
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<script type="text/javascript">

		$('#refresh-captcha').click(function(){
			$(this).blur();
			$("#img-captcha").attr('src', "{{ env('APP_URL') . '/generate_captcha.php'  }}");
		});

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

		$("#frmRelaod").validate({
			errorClass: 'help-block',
	        errorElement: 'span',
	        rules: {
	            reload_prices:{
	            	required: true,
	            },
	            captcha:{
	            	required: true,
	            }
	        },
	        messages: {
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

	    $("#btn-reload").click(function(){
			if($("#frmRelaod").valid()){
				check_captcha($('#frmRelaod').serialize(), function(r){
					$("#img-captcha").attr('src', "{{ env('APP_URL') . '/generate_captcha.php'  }}");
					if(r.status == 200){
                    	$(".order-list-body ul").html('');
                    	var r_value = $('#reload-prices').val();
                    	if(r_value != ''){
							$(".order-list-body ul").append(`<li>
											<div class="row">
												<div class="col-sm-8 col-xs-7">
												Reload a group
												</div>
												<div class="col-sm-2 col-xs-2">
													`+1+`
												</div>
												<div class="col-sm-2 col-xs-3 price">
													&euro; `+ r_value +`
												</div>
											</div>
										</li>`);
							$('#total_amount').html(r_value);
						}
                        $('.step2').removeClass('hide');
                        $('html, body').animate({
							scrollTop: $('.step2').offset().top
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

		$('#btn-step2').click(function(){
			$('.' + $(this).data('next')).removeClass('hide');
			$('html, body').animate({
				scrollTop: $('.' + $(this).data('next')).offset().top
			}, 'slow');
		});

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
				var group_id = "{{ $group_id }}";
	            var group_name = $('#group_name').val();
	            var relaod_group_amount = $('#total_amount').html();

				if((group_id == '' || group_id == null || group_id == undefined || group_name == '' || group_name == null || group_name == undefined || relaod_group_amount == '' || relaod_group_amount == null || relaod_group_amount == undefined)){
					showMessage(412, "Something went wrong! Please try again later");
					return false;
				}
				else{
					var expire = $('#frmCardPayment input[name="expire"]').val().split('/');
					$('#shoping-form input[name="group_id"]').val(group_id);
					$('#shoping-form input[name="group_name"]').val(group_name);
					$('#shoping-form input[name="relaod_group_amount"]').val(relaod_group_amount);
					$('#shoping-form input[name="cardholder_name"]').val($('#frmCardPayment input[name="cardholder_name"]').val());
					$('#shoping-form input[name="card_number"]').val($('#frmCardPayment input[name="card_number"]').val());
					$('#shoping-form input[name="exp_month"]').val(expire[0]);
					$('#shoping-form input[name="exp_year"]').val(expire[1]);
					$('#shoping-form input[name="cvv"]').val($('#frmCardPayment input[name="cvv"]').val());
					$('#shoping-form').submit();
					addOverlay();
				}

			}
		});

		$('#btn-paypal').click(function(){
			var action = "{{ route('make_paypal_payment') }}";
			var group_id = "{{ $group_id }}";
            var group_name = $('#group_name').val();
            var relaod_group_amount = $('#total_amount').html();

			if((group_id == '' || group_id == null || group_id == undefined || group_name == '' || group_name == null || group_name == undefined || relaod_group_amount == '' || relaod_group_amount == null || relaod_group_amount == undefined)){
				showMessage(412, "Something went wrong! Please try again later");
				return false;
			}

			$.ajax({
		        url: action,
		        type: 'POST',
		        dataType: 'json',
		        beforeSend: addOverlay,
		        data: {
		            _token: $('meta[name="csrf_token"]').attr('content'),
		            group_id: group_id,
		            group_name: group_name,
		            relaod_group_amount: relaod_group_amount,
		        },
		        success: function(r){
		        	if(r.status == 200){
		        		var data = r.data;
		        		$('#paypal_payment_form #paypal_item_name').val(data.item_name);
		        		$('#paypal_payment_form #paypal_item_amount').val(data.item_price);
		        		$('#paypal_payment_form #paypal_item_id').val(data.item_type +'&'+ data.item_id);
		        		$('#paypal_payment_form').submit();
		        	}
		        	else{
		        		showMessage(r.status, r.message);
		        	}
		        },
		        // complete: removeOverlay
		    });
		});

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
	</script>
@endpush