@extends('layouts.app')

@section('content')
<main>
    <section class="register-section">
        <div class="container">
            <div class="register-form text-center">
                <h2>Forgot Password</h2>
                <form class="forget-form" id="frmForgot" role="form" method="POST" action="{{ route('password.email') }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" name="username" class="form-control" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <button type="submit" class="theme-btn">Send</button>                   
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){

        $('#frmForgot').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    required: true,
                    valid_email:true
                }
            },

            messages: {
                username: {
                    required: "@lang('validation.required', ['attribute'=>'email address'])",
                    valid_email: "@lang('validation.email', ['attribute'=>'email address'])"
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#frmForgot')).show();
                $('#frmForgot').addClass('form-error');
            },

            highlight: function (element) { // hightlight error inputs
                $('#frmForgot').addClass('form-error');
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
                $('#frmForgot').removeClass('form-error');
                form.submit();
            }
        }); 
    })
    
</script>
@endpush