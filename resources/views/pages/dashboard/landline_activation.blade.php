@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="landline-activation-section">
            <div class="text-center">
                <h1>Request a national<br/>landline number activation</h1>
                <form action="{{ route('add_national_number') }}" method="post" id="frmNational" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select id="change_xxsim_number" name="xxsim_number" class="custom country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-xxsim-card">
                            @forelse(Auth::user()->cards as $card)
                                <option value="" selected disabled>Select a xxsim card</option>
                                <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                            @empty
                                <option value="" selected disabled>No card available</option>
                            @endforelse
                        </select>
                        @if ($errors->has('xxsim_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('xxsim_number') }}</strong>
                            </span>
                        @endif
                        <span id="error-xxsim-card"></span>
                    </div>
                    <div class="form-group">
                        <select id="change_country" name="country" class="custom country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false}' data-error-container="#error-country">
                            <option value="" selected disabled>Select a country</option>
                            @foreach($countries as $country)
                                {{-- <option value="{{ $country->id }}">{{ $country->name }}</option> --}}
                                <option value="{{ $country->country }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                        <span id="error-country"></span>
                    </div>
                    <div class="form-group">
                        <select id="change_phone" name="national_number" class="custom phone" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-phone">
                            <option value="" selected disabled>Select a phone number</option>
                        </select>
                        @if ($errors->has('national_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('national_number') }}</strong>
                            </span>
                        @endif
                        <span id="error-phone"></span>
                    </div>
                    <button type="submit" class="btn simple-btn yellow">Activate</button>
                </form>
            </div>
    </div>

</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){
        $('#change_country').change(function(){
            var action = "{{ route('get_national_numbers') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                beforeSend: addOverlay,
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    country: $('#change_country').val(),
                },
                success: function(r){
                    if(r.status == 200){
                        $('#change_phone').html(`<option value="" selected disabled>Select a phone number</option>`);
                        for (var i = r.numbers.length - 1; i >= 0; i--) {
                            $('#change_phone').append(`<option value="`+r.numbers[i].number+`">+`+r.numbers[i].number+`</option>`);
                        }
                        $('#change_phone').trigger('change');
                    }
                    else{
                        showMessage(r.status, r.message);
                    }
                },
                complete: removeOverlay
            });
        });

        $("#frmNational").validate({
            rules: {
                xxsim_number:{
                    required:true,
                },
                country:{
                    required:true,
                },
                national_number:{
                    required:true,
                },
            },
            messages: {
                xxsim_number:{
                    required:"@lang('validation.required',['attribute'=>'xxsim card'])",
                },
                country:{
                    required:"@lang('validation.required',['attribute'=>'country'])",
                },
                national_number:{
                    required:"@lang('validation.required',['attribute'=>'National card'])",
                },
            },
            errorClass: 'help-block',
            errorElement: 'span',
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('#frmNational').addClass('form-error');
                $('.alert-danger', $('#frmNational')).show();
            },
            highlight: function (element) {
                $('#frmNational').addClass('form-error');
               $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
               $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if (element.attr("data-error-container")) {
                    console.log(element.attr("data-error-container"));
                    error.appendTo(element.attr("data-error-container"));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                $('#frmNational').removeClass('form-error');
                form.submit();
            }
        });
    });
</script>
@endpush