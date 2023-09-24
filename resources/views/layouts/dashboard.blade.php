<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>XXSIM International roaming SIM card</title>
    <!--Favicon Included-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('dashboard/images/favicon.ico/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('dashboard/images/favicon.ico/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('dashboard/images/favicon.ico/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/images/favicon.ico/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('dashboard/images/favicon.ico/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('dashboard/images/favicon.ico/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('dashboard/images/favicon.ico/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('dashboard/images/favicon.ico/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/images/favicon.ico/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="i{{ asset('dashboard/mages/favicon.ico/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/images/favicon.ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('dashboard/images/favicon.ico/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/images/favicon.ico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('dashboard/images/favicon.ico/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('dashboard/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('dashboard/css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/jcf.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <!-- <link href="{{ asset('global/css/jquery.datetextentry.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('dashboard/css/style.css'). "?" . filemtime(public_path('dashboard/css/style.css')) }}" rel="stylesheet">

    <!-- Extra CSS -->
    <link href="{{ asset('global/css/custom.css'). "?" . filemtime(public_path('global/css/custom.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @stack('page_css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <noscript><meta http-equiv="refresh" content="0; URL={{ route('no-script') }}"></noscript>

    <script type="text/javascript">
        var GLOBAL_ASSET = "{{ asset('global') }}";
        var CARD_API_URL = "{{ route('call_card_api') }}";
    </script>
     <!-- jQuery -->
    <script src="{{ asset('dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/js/jcf.js') }}"></script>
    <script src="{{ asset('dashboard/js/jcf.scrollable.js') }}"></script>
    <script src="{{ asset('dashboard/js/jcf.select.js') }}"></script>
    <script src="{{ asset('dashboard/js/jcf.checkbox.js') }}"></script> 
    <script>
            $(function() {
                 jcf.replaceAll();
            });
    </script>
</head>

<body>
    <!-- Header Start -->
    <header>
        <div class="google-translate dashboard">
            <div id="google_translate_element"></div>
        </div>
        @include('shared.dashboard_header')
    </header>
    <!-- Header End -->

    <div id="wrapper">
        <!-- Sidebar -->
        @if(!empty($advance_view) && $advance_view == 'y')
            @include('shared.advance_sidebar')
        @else
            @include('shared.simple_sidebar')
        @endif
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-content-wrapper -->

        <!-- BEGIN FLASH MESSAGE CONTAIN -->
        @include('flash::message')
        <!-- END FLASH MESSAGE CONTAIN -->

    </div>
    <!-- /#wrapper -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    
    
    <script src="{{ asset('dashboard/js/moment.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Extra Javascript -->
    <script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('global/js/jquery.datetextentry.js') }}"></script>
    <script src="{{ asset('global/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/js/card_api.js'). "?" . filemtime(public_path('dashboard/js/card_api.js')) }}" type="text/javascript"></script>

    @stack('page_js')

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    
    <script type="text/javascript">
        $("#chnage_dashboard").change(function(){
            if($(this).val() == "advance"){
                window.location = "{{ route('dashboard.home.advance') }}";
            }
            else if($(this).val() == "simple"){
                window.location = "{{ route('dashboard.home') }}";
            }
        });
    </script>

    <script type="text/javascript">
        if(!navigator.cookieEnabled) {
            window.location.href = "{{ route('no-cookie') }}";
        }
    </script>

    <script>
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-top-right",
          "onclick": null,
          "preventDuplicates": true,
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

    @stack('scripts')

    <script type="text/javascript">
        $('#change-card').select2();
        if("{{ session('status') }}" != ''){
            showMessage(200, "{{ session('status') }}");
        }
    </script>

    <?php //<!-- Start of xxsim Zendesk Widget script -->
    //<script>/*<![CDATA[*/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","8b8405b5-a117-483a-ba87-6b8139bb37c3");/*]]>*/</script>
    //<!-- End of xxsim Zendesk Widget script --> ?>

    <!--Start of Zendesk Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set._.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");$.src="https://v2.zopim.com/?6QSe2gSvZtWT4S0cyob6Jpu23S0suZc5";z.t=+new Date;$.type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");</script>
    <!--End of Zendesk Chat Script-->

    <script type="text/javascript">
        $(document).ready(function(){
            $('.goog-te-combo').addClass('jcf-ignore');
        });
    </script>
     <!-- Google Translate -->
     <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109237539-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109237539-1');
    </script>

</body>

</html>
