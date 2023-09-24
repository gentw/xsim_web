@extends('layouts.dashboard')

@section('content')

<div id="page-content-wrapper" class="send-sms">
	<div class="text-center send-sms-wrapper">
		<h1>Send SMS</h1>
		<p>Please remember you can only use this tool to send SMS to a XXSIM number.</p>
		<form action="javascript:;" class="form-step" id="frm-sms">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>FROM</label>
						<select name="from_number" id="from_number" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-from-number">
                        	<option value="" selected disabled hidden>Select Number</option>
                        	@foreach(Auth::user()->cards as $card)
		                        <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
		                    @endforeach
                    	</select>
                    	<span id="error-from-number"></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>TO NUMBER</label>
						<input type="text" name="to_number" id="to_number" class="form-control" placeholder="Enter Number : 372xxxxxxxx">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label>MESSAGE</label>
						<textarea name="message" id="message" rows="4" class="form-control" placeholder="Enter Message" maxlength="150"></textarea>
					</div>
				</div>
				<div class="col-sm-12">
                     <div class="text-center"><button type="submit" class="btn simple-btn yellow">Send</button></div>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
	$('#frm-sms').validate({
        rules: {
            from_number:{
                required: true,
                digits: true,
            },
            to_number:{
                required: true,
                minlength:6,
                maxlength:15,
                digits: true,
            },
            message:{
                required: true,
                not_empty: true,
                maxlength: 150,
            },
        },
        messages: {
            from_number:{
                required:"@lang('validation.required',['attribute'=>'from number'])",
            },
            to_number:{
                required:"@lang('validation.required',['attribute'=>'to number'])",
                minlength:"@lang('validation.min.string',['attribute'=>'to number', 'min' => 6])",
                maxlength:"@lang('validation.max.string',['attribute'=>'to number', 'max' => 15])",
            },
            message:{
                required:"@lang('validation.required',['attribute'=>'to number'])",
            },
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('#frm-sms').addClass('form-error');
            $('.alert-danger', $('#frm-sms')).show();
        },
        highlight: function (element) {
            $('#frm-sms').addClass('form-error');
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
        },
        submitHandler: function (form) {
            $('#frm-sms').removeClass('form-error');
            form.submit();
        }
    });

    $("#frm-sms").submit(function(){
        if($(this).valid()){
            var data = {'api_name': 'sms', 'anum': $('#from_number').val(), 'bnum': $('#to_number').val(), 'msg': $('#message').val()};
            call_api(data, function(r){
                if(r.status == 200){
                    showMessage(200, "SMS successfully sent.");
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }
        else{
            return false;
        }
    });
</script>
@endpush