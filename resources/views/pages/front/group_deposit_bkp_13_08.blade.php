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
		                       				<input type="text" name="captcha" id="captcha" class="form-control">
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
                        <form action="{{ env('PAYPAL_URL') }}" method="post" id="paypal_payment_form">
                            <input type="hidden" name="business" value="{{ ENV('PAYPAL_BUSINESS') }}" >
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" id="paypal_item_name" value="">
                            <input type="hidden" name="landing_page" value="billing">
                            <input type="hidden" name="currency_code" value="EUR">
                            <input type="hidden" name="amount" id="paypal_item_amount" value="">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="cancel_return" value="{{ route('paypal_payment_fail') }}">
                            <input type="hidden" name="return" value="{{ route('paypal_payment_success') }}">
                            <input type="hidden" name="notify_url" value="{{ route('paypal_payment_notify') }}"> 
                            <input type='hidden' name='rm' value='2'>
                            <input type='hidden' name='custom' id="paypal_item_id" value=''/>
                        </form>
                        <!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="javascript:;" id="btn-paypal-payment" title="How PayPal Works"><img src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_l.png" alt="Pay with PayPal" /></a></td></tr></table><!-- PayPal Logo -->
                    </div>
                </div>
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
				var action = "{{ route('paypal_payment') }}";
				var next_section = $(this).data('next');
				$.ajax({
			        url: action,
			        type: 'POST',
			        dataType: 'json',
			        beforeSend: addOverlay,
			        data: {
			            _token: $('meta[name="csrf_token"]').attr('content'),
			            group_id: "{{ $group_id }}",
			            group_name: $('#group_name').val(),
			            relaod_group_amount: $('#total_amount').html(),
			        },
			        success: function(r){
			        	if(r.status == 200){
			        		var data = r.data;
			        		$('#paypal_payment_form #paypal_item_name').val(data.item_name);
			        		$('#paypal_payment_form #paypal_item_amount').val(data.item_price);
			        		$('#paypal_payment_form #paypal_item_id').val(data.item_type +'&'+ data.item_id);
			        		$('.' + next_section).removeClass('hide');
			        	}
			        	else{
			        		showMessage(r.status, r.message);
			        	}
			        },
			        complete: removeOverlay
			    });
		});

		$('#btn-paypal-payment').click(function(){
			$('#paypal_payment_form').submit();
		});
	</script>
@endpush