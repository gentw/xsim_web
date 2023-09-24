<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('front/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            @php $routeName = Route::currentRouteName(); @endphp
            <ul class="nav navbar-nav main-menu">
                <li @if($routeName == 'home') class="active" @endif><a href="{{ route('home') }}">Home</a></li>
                <li @if($routeName == 'features' || $routeName == 'corporate') class="active" @endif><a href="{{ route('features') }}">FEATURES</a></li>
                <li @if($routeName == 'about') class="active" @endif><a href="{{ route('about') }}">ABOUT</a></li>

                <li @if($routeName == 'online_shop') class="active" @endif id="online_shop"><a href="{{ route('online_shop') }}">ONLINE SHOP</a>
                </li>
                <li @if($routeName == 'support') class="active" @endif><a href="{{ route('support') }}">SUPPORT</a></li>
                <li @if($routeName == 'quick_start') class="active" @endif><a href="{{ route('quick_start') }}">QUICK START</a></li>
                <li ><a href="{{ route('home') . '#call-rates' }}">RATES AND COVERAGE</a></li>
                <li ><a href="{{ route('home') . '/blog' }}">Blog</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right login-menu">
                @if(Auth::guest())
                    <li><a href="{{ route('login') }}"><img src="{{ asset('front/images/log-in-arrow.png') }}" alt="log-in-arrow"></img> <span>Log in / Register</span></a></li>
                @else
                    <li><a href="{{ route('dashboard.home') }}"><img src="{{ asset('front/images/user.png') }}" alt="user"></img> <span>My Account</span></a></li>
                @endif
                <!-- <li><a href="#"><img src="{{ asset('front/images/comments.png') }}" alt="comments"></img></a></li> -->
            </ul>
        </div>
    </div>
</nav> 
@push('scripts')
    <script type="text/javascript">
        if(isMobile.any()) {
            $("#online_shop > a").attr('href','{{ route("online_shop"). "#buy_card"  }}');
        }        
    </script>
@endpush