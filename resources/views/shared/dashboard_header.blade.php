<nav class="navbar navbar-default dashboard">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sideNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ (!empty($advance_view) && $advance_view == 'y') ? route('dashboard.home.advance') : route('dashboard.home') }}"><img src="{{ asset('dashboard/images/logo.png') }}" alt="logo"></a>
            <a href="#menu-toggle" class="visible-xs sidebar-toggle" id="menu-toggle"><img class="icon" src="{{ asset('dashboard/images/user.png') }}" alt="user"></a>
        </div>
        <div class="collapse navbar-collapse" id="sideNavbar">
            <ul class="nav navbar-nav main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('features') }}">FEATURES</a></li>
                <li><a href="{{ route('about') }}">ABOUT</a></li>
                <li><a href="{{ route('online_shop') }}">ONLINE SHOP</a></li>
                <li><a href="{{ route('support') }}">SUPPORT</a></li>
            </ul>
        </div>
    </div>
</nav> 