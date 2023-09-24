@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="add-card-section">
        <h1>Add a Card</h1>
        <form action="{{ route('action_add_card') }}" id="frmstore" method="post">
            {{ csrf_field() }}
            <div class="input-group simple-shadow">
              <span class="input-group-addon" id="basic-addon1">+</span>
              <input type="text" name="card_number" class="form-control" data-error-container="#error-card-number" placeholder="372xxxxxxxx" value="{{ old('card_number') }}" aria-describedby="basic-addon1">
            </div>
            <div id='error-card-number'></div>
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
            card_number:{
                required:true,
                digits: true,
                minlength: 6,
                maxlength: 15,
            }
        },
        messages: {
            card_number:{
                required:"@lang('validation.required',['attribute'=>'card number'])",
                digits: "@lang('validation.numeric', ['attribute'=>'card number'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'card number', 'min'=>6])",
                maxlength: "@lang('validation.max.string', ['attribute'=>'card number', 'max'=>15])",
            }
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) { //display error alert on form submit   
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