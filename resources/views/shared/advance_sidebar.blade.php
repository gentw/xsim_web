<div id="sidebar-wrapper">
    <div class="user-info">
        <h2>{{ Auth::user()->contact->firstname . " " . Auth::user()->contact->lastname }}</h2>
        <p class="type">Advanced Dashboard</p>
    </div>
    <select id="chnage_dashboard" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
        <option value="advance">Advanced Dashboard</option>
        <option value="simple">Basic Dashboard</option>
    </select>
    <ul class="sidebar-menu">
        <!-- <li><a href="{{ route('dashboard.home.advance') }}">Dashboard</a></li> -->
        <li><a href="{{ route('dashboard.history') }}">History</a></li>
        <li><a href="{{ route('dashboard.add_card') }}">Add a SIM Card</a></li>
        <li><a href="{{ route('dashboard.referrals') }}">Refer a friend</a></li>
        <li><a href="{{ route('dashboard.landline_activation_number') }}">landline activation</a></li>

        @if(Auth::user()->cards->count() > 1)
            <li><a href="{{ route('dashboard.auto_reload', 'advance') }}">corporate account</a></li>
        @endif
        {{-- 
            @elseif(Auth::user()->cards->count() == 1 && (Auth::user()->cards)[0]->group_id != NULL)
            <li><a href="{{ route('dashboard.auto_reload', 'advance') }}">corporate account</a></li>
        --}}
        
        <li><a href="{{ route('dashboard.geolocalization') }}">geolocalization</a></li>
        <li><a href="{{ route('dashboard.gprs') }}">GPRS Packages</a></li>
        <li><a href="{{ route('dashboard.send_sms', 'advance') }}">Send SMS</a></li>
        {{-- <li><a href="{{ route('dashboard.web_call', 'advance') }}">Web Call</a></li> --}}
    </ul>
    <ul class="sidebar-bottom-menu">
        <li><a href="{{ route('dashboard.profile', 'advance') }}"><img class="icon" src="{{ asset('dashboard/images/user.png') }}" alt="user"></img> <span>My Account</span></a></li>
        @if(Auth::guest())
            <li><a href="{{ route('login') }}"><img class="icon" src="{{ asset('dashboard/images/log-in-arrow.png') }}" alt="log-in-arrow"></img> <span>Log in</span></a></li>
        @else
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><img class="icon" src="{{ asset('dashboard/images/log-in-arrow.png') }}" alt="log-in-arrow"></img> <span>Logout</span></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
        <!-- <li><a href="#"><img class="icon" src="{{ asset('dashboard/images/comments.png') }}" alt="comments"></img>Live Chat</a></li> -->
    </ul>
</div>
