<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Forgot Password - {{config('app.name')}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('admin/css/font-family.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('admin/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('admin/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('admin/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->

        <!--Favicon Included-->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('admin/images/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('admin/images/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('admin/images/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/images/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('admin/images/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('admin/images/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('admin/images/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('admin/images/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/images/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('admin/images/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin/images/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon-16x16.png') }}">
        <meta name="msapplication-TileImage" content="{{ asset('admin/images/ms-icon-144x144.png') }}">

        <noscript><meta http-equiv="refresh" content="0; URL={{ route('no-script', 'admin') }}"></noscript> 
    </head>
    <!-- END HEAD -->

    <body class="login">

        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{ url('admin/login') }}">
                <img src="{{ asset('admin/images/logo.png') }}" alt="" class="logo-main" /> </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN LOGIN -->
        <div class="content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <!-- BEGIN LOGIN FORM -->
            <form class="forget-form" id="frmForgot" role="form" method="POST" action="{{ url('admin/password/email') }}">
                {{ csrf_field() }}
                <h3>Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" name="email" id="email" type="email" value="{{ old('email') }}" placeholder="E-mail address" /> 
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ url('admin/login') }}" class="btn red">Back to login</a>
                    <button type="submit" class="btn green pull-right"> Submit </button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->

        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> {{date('Y')}} &copy; {{config('app.name')}} </div>
        <!-- END COPYRIGHT -->

        <!--[if lt IE 9]>
        <script src="../assets/plugins/respond.min.js"></script>
        <script src="../assets/plugins/excanvas.min.js"></script> 
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('admin/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('admin/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('admin/js/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <script type="text/javascript">
            $(function(){
                // $.backstretch([
                //     "{{ asset('admin/images/login/bg.png') }}",
                //     ]
                // );

                jQuery.validator.addMethod("valid_email", function(value, element) {
                  return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,})?$/.test(value);
                }, "Please enter a valid email address.");

                $('#frmForgot').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        email: {
                            required: true,
                            valid_email:true
                        }
                    },

                    messages: {
                        email: {
                            required: "@lang('validation.required', ['attribute'=>'email address'])",
                            valid_email: "@lang('validation.email', ['attribute'=>'email address'])"
                        }
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit   
                        $('.alert-danger', $('.login-form')).show();
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        label.closest('.form-group').removeClass('has-error');
                        label.remove();
                    },

                    errorPlacement: function (error, element) {
                        error.insertAfter(element.closest('.input-icon'));
                    },

                    submitHandler: function (form) {
                        form.submit();
                    }
                }); 
            });
            if(!navigator.cookieEnabled) {
                window.location.href = "{{ route('no-cookie', 'admin') }}";
            }
        </script>
        </script>
    </body>
</html>