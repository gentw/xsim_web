@extends('layouts.app')

@section('content')
<main>
    <section class="register-section">
        <div class="container">
            <div class="register-form text-center">
                <h2>Reset Your Password</h2>
                <form class="login-form" id="frmReset" role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email', '') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password', '') }}" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', '') }}" placeholder="Confirm Password">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <button type="submit" class="theme-btn">Reset</button>                   
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){

            $('#frmReset').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    email: {
                        required: true,
                        email:true
                    },
                    password:{
                        required:true,
                        minlength:6,
                        no_space:true
                    },
                    password_confirmation:{
                        required:true,
                        minlength:6,
                        no_space:true,
                        equalTo:"#password"
                    }
                },

                messages: {
                    email: {
                        required: "@lang('validation.required', ['attribute'=>'email address'])",
                        email: "@lang('validation.email', ['attribute'=>'email address'])"
                    },
                    password:{
                        required: "@lang('validation.required', ['attribute'=>'password'])",
                        minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])",
                    },
                    password_confirmation:{
                        required:"@lang('validation.required', ['attribute'=>'confirm password'])",
                        minlength: "@lang('validation.min.string', ['attribute'=>'confirm password', 'min'=>6])",
                        equalTo:"@lang('validation.same', ['attribute'=>'confirm password', 'other'=>'password'])"
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    $('.alert-danger', $('#frmReset')).show();
                    $('#frmReset').addClass('form-error');
                },

                highlight: function (element) { // hightlight error inputs
                    $('#frmReset').addClass('form-error');
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
                    $('#frmReset').removeClass('form-error');
                    form.submit();
                }
            });
        });
    </script>
@endpush