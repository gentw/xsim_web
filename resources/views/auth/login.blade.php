@extends('layouts.app')

@section('banner')
<section class="banner online-shop">
    <div class="container">
        <div class="desc">
            <h1>XXSIM is a unique <br />product for your company</h1>
            <a href="{{ route('online_shop') }}" class="theme-btn outlined">Get the XXSIM</a>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <section class="login-register-section" id="login">
        <div class="container">
           <h1>Login or Register</h1>
            <div class="row">
                <div class="col-md-8">
                    <form class="login-form" id="frmLogin" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="login-register-form text-center shadow-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>Log In</h3>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <input type="email" name="username" class="form-control" value="{{ old('username') }}" placeholder="Email">
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <p><a href="{{ route('password.request') }}" id="" class="yellow-color">Click here </a> to reset your password.</p>
                                    <button type="submit">Log In</button>
                                </div>
                                <div class="col-sm-6">
                                    <h3>Register</h3>
                                     <p class="margint">Click below to create an account and get started immediately.</p>
                                    <a class="theme-btn inverse" href="{{ route('register') }}">Register</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="contact-you-block shadow-box">
                        <h4>Do you want our <br />sales to contact you?</h4>
                        <p>We will contact you within the next 24h</p>
                        <div class="submit-box">
                            <form action="javascript:;" id="contact-phone">
                                <input type="text" name="phone" placeholder="Phone Number">
                                <button type="submit">submit</button>
                            </form>
                        </div>
                        <h4>Do you want our <br />sales to contact you through email?</h4>
                        <p>We will contact you within the next 24h</p>
                        <div class="submit-box">
                            <form action="javascript:;" id="contact-email">
                                <input type="text" name="email" placeholder="Email">
                                <button type="submit">submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){
        var width = $(window).width();
        if(width < 768){
            $('html, body').animate({
                scrollTop: $('#login').offset().top - 105
            }, 'slow');
        }else{
            $('html, body').animate({
                scrollTop: $('#login').offset().top
            }, 'slow');
        }

        $('#frmLogin').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
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
                username: {
                    required: "@lang('validation.required', ['attribute'=>'email'])",
                    email:"@lang('validation.email', ['attribute'=>'email'])"
                },
                password: {
                    required: "@lang('validation.required', ['attribute'=>'password'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('#frmLogin').addClass('form-error');
                $('.alert-danger', $('#frmLogin')).show();
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

            submitHandler: function (form) {
                $('#frmLogin').removeClass('form-error');
                form.submit();
            }
        });
    });

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
</script>

@endpush