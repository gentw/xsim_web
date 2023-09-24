<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ !empty($custom_title) ? $custom_title : ($title != '' ? $title : '') }} - {{config('app.name')}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta content="{{csrf_token()}}" name="csrf_token" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('admin/css/font-family.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('admin/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('admin/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('admin/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/themes/light.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('admin/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/bootstrap-datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        @stack('page_css')
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

        <script type="text/javascript">
            const GLOBAL_ASSET = "{{ asset('global') }}";
        </script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
        <!-- BEGIN HEADER -->
        @include('admin.shared.header')
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN SIDEBAR -->
            @include('admin.shared.sidebar_left')
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>@stack('page_title_icon'){{ !empty($custom_title) ? $custom_title : ($title != '' ? $title : '') }}</h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD-->
                    
                    <!-- BEGIN PAGE BREADCRUMB -->
                    @yield('breadcrumb')
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    @yield('content')
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->

            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FLASH MESSAGE CONTAIN -->
        @include('flash::message')
        <!-- END FLASH MESSAGE CONTAIN -->

        <!-- BEGIN FOOTER -->
        @include('admin.shared.footer')
        <!-- END FOOTER -->

        <!--[if lt IE 9]>
        <script src="../assets/plugins/respond.min.js"></script>
        <script src="../assets/plugins/excanvas.min.js"></script> 
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('admin/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('admin/js/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ asset('admin/js/layout.min.js') }}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('admin/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap-datatable/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/js/custom.js') }}" type="text/javascript"></script> 
        @stack('page_js')
        <!-- END PAGE LEVEL SCRIPTS -->

        <script>
            var oTable;
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "positionClass": "toast-top-right",
              "onclick": null,
              "showDuration": "1000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            $('[data-toggle="tooltip"]').tooltip();
        </script>

        <script type="text/javascript">
            if(!navigator.cookieEnabled) {
                window.location.href = "{{ route('no-cookie', 'admin') }}";
            }
        </script>
        @stack('scripts')
    </body>
</html>