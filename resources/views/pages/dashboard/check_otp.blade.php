@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="add-card-section">
        <h1>Add a Card</h1>
        <form action="{{ route('action_check_card') }}" id="frmstore" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="card_number" value="{{ old('card_number', $card_number) }}">
            <input type="number" name="activation_code" min="1" class="form-control simple-shadow" placeholder="Enter Activation code" value="{{ old('activation_code') }}" />
            @if ($errors->has('card_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('card_number') }}</strong>
                </span>
            @endif
            <button type="submit" class="simple-btn">submit</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $("#frmstore").validate({
        rules: {
            activation_code:{
                required:true,
                digits: true,
                minlength: 4,
                maxlength: 4,
                min: 1,
            }
        },
        messages: {
            activation_code:{
                required:"@lang('validation.required',['attribute'=>'activation code'])",
                digits: "@lang('validation.numeric', ['attribute'=>'activation code'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'activation code', 'min'=>4])",
                maxlength: "@lang('validation.max.string', ['attribute'=>'activation code', 'max'=>4])",
                min: "@lang('validation.min.numeric', ['attribute'=>'activation code', 'min'=>1])",
            }
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) { 
            $('#frmstore').addClass('form-error');
            $('.alert-danger', $('#frmstore')).show();
        },
        highlight: function (element) {
            $('#frmstore').addClass('form-error');
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
           $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.attr("type") == "radio") {
                  error.appendTo('.a');
            }else{
                if (element.attr("data-error-container")) {
                    console.log(element.attr("data-error-container"));
                    error.appendTo(element.attr("data-error-container"));
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form) {
            $('#frmstore').removeClass('form-error');
            form.submit();
        }
    });
    $(document).on('submit','#frmstore',function(){
        if($("#frmstore").valid()){
            return true;
        }else{
            return false;
        }
    });
</script>
@endpush