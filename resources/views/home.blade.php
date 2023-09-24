@extends('layouts.app')

@if(!empty($page_content))
    @section('content')
    {!! $page_content !!}
    <div id="call-rates"></div>
    <section class="call-rates-coverage-section">
        <div>
            <div class="call-rates-block">
                <h4 class="titleh3">call rates</h4>
                <p class="desc">The best rates in over 190 countries</p>
                <div class="selection-block">
                    <form>
                        <h5 class="title">ROAMING IN</h5>
                        <select id="from_country" class="custom change-country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                            <!-- <option class="hideme">Select a country</option> -->
                            @foreach($counties as $country)
                                <option value="{{ $country->country }}" @if($country->country == 'Germany') selected @endif>{{ $country->country }}</option>
                            @endforeach
                            <!-- <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option> -->
                        </select>
                        <h5 class="title">CALLING TO</h5>
                        <select id="to_country" class="custom change-country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                            <!-- <option class="hideme">Select a country</option> -->
                            @foreach($counties as $country)
                                <option value="{{ $country->country }}" @if($country->country == 'United Arab Emirates') selected @endif>{{ $country->country }}</option>
                            @endforeach
                            <!-- <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option> -->
                        </select>
                    </form>
                </div>
                <div class="desc-block">
                    <div class="item">
                        <h5>Price Per Minute <span id="call_price" class="left">{{ '€' . ($rate_data['call_price'] + $rate_data['extra']) }}</span></h5>
                    </div>
                    <div class="item incoming-calls">
                        <h5>Incoming Calls</h5>
                        <ul class="yellow-color">
                            <li>
                                <span id="lbl_from_country">Germany</span> 
                                <span id="call_from_price" class="left">{{ !empty($rate_data['call_received_price_from']) ? '€' . $rate_data['call_received_price_from'] : 'free' }}</span>
                            </li>
                            <!-- <li>
                                <span id="lbl_to_country">United Arab Emirates</span> 
                                <span id="call_to_price" class="left">{{ !empty($rate_data['call_received_price_to']) ? '€' . $rate_data['call_received_price_to'] : 'free' }}</span>
                            </li> -->
                        </ul>
                    </div>
                    <div class="item">
                        <ul>
                            <li>SMS Rates <span id="sms_price" class="left">{{ !empty($rate_data['sms_price']) ? '€' . $rate_data['sms_price'] : '-' }}</span></li>
                            <li>SMS Through XXSIM <span id="xxsim_sms_price" class="left">{{ !empty($rate_data['xxsim_sms_price']) ? '€' . $rate_data['xxsim_sms_price'] : '-' }}</span></li>
                            <li>MENU or USSD <span class="left"></span></li>
                            <li>GPRS (1MB) <span id="gprs_price" class="left">{{ !empty($rate_data['gprs_price']) ? '€' . $rate_data['gprs_price'] : '-' }}</span></li>
                            <li>XXSIM to XXSIM <span id="xxsim_price" class="left">{{ !empty($rate_data['xxsim_price']) ? '€' . $rate_data['xxsim_price'] : '-' }}</span></li>
                        </ul>
                    </div>
                </div>
                <a href="{{ asset('files/XXSIMRates.xlsx') }}" download >Click here to see all network operators</a>
            </div>
            <div class="space-block">
            </div>
            <div class="coverage-block">
                <h3>coverage</h3>
                <!-- <p class="desc">Click on any country to find out what ist coverage is like</p> -->
                <div class="map-block text-center">
                    <img src="{{ asset('front/images/map.png') }}" alt="map">
                </div>
            </div>
        </div>
    </section>
    @endsection
@else
    @section('banner')
    <section class="banner home">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="desc">
                        <h1>Introducing the best<br />
                        international<br />
                        SIM Card - <span>XXSIM</span></h1>
                        <p>Have peace of mind and forget about international roaming charges with XXSIM. We provide free incoming calls and the best rates on outgoing calls as well as roaming data. Order your SIM&nbsp;now or download our app to get started and make card management easier than ever.</p>
                        <ul class="list-inline">
                            <li><a href="https://itunes.apple.com/in/app/xxsim-international-sim-card/id1418454539?mt=8" target="_blank"><img alt="xxsim-mobile" src="{{ asset('front/images/app-store-badge.png') }}" /></a></li>
                            <li><a href="https://play.google.com/store/apps/details?id=com.xx_sim" target="_blank"><img alt="xxsim-mobile" src="{{ asset('front/images/google-play-badge.png') }}" /></a></li>
                            <li><a class="theme-btn" href="{{ route('online_shop') }}">order yours</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 text-center">
                    <div class="xxsim-mobile"><!-- <img src="https://www.xxsim.com/front/images/xxsim-mobile.png" alt="xxsim-mobile"> -->
                        <img alt="xxsim-mobile" class="mobile-front" src="{{ asset('front/images/xxsim_gif.gif') }}" />
                        <img alt="xxsim-mobile" class="mobile-bg" src="{{ asset('front/images/xxsim_mobile.svg') }}"/>
                    </div>
                </div>
            </div>
            <div class="home-intro-container"></div>
        </div>
    </section>
    @endsection

    @section('content')
    <main>
        <section class="dont-miss-it-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-5">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/VVhArJrXyVQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <div class="bg-img"><img src="{{ asset('front/images/dont-miss-it.png') }}" alt="sim card"></div>
                    <div class="col-sm-7">
                        <div class="desc-block">
                            <h2 class="titleh1">Don't Miss It!</h2>
                            <p>The XXSIM now comes in a 3-in-1 format that fits any phone on the market (SIM, microSIM and nanoSIM). Just insert the card and follow a few simple instructions to get connected immediately. </p>
                            <ul class="list-unstyled points">
                                <li>No monthly charges</li>
                                <li>Outgoing calls approximately 85% cheaper</li>
                                <li>6 ways to call XXSIM for free (national numbers, toll free numbers, skype, viber, webcall, SIP trunk)</li>
                                <li>XXSIM card positioning on Google Maps®</li>
                                <li>Calls from XXSIM to XXSIM in a European country to a mobile# or landline# in a European country will be invoiced €0.19/Min only</li>
                                <li>Free delivery worldwide</li>
                            </ul>
                            <ul class="list-unstyled points">
                                <li>Free call forwarding to any number, including mobile, to avoid usage of a dual SIM phone</li>
                                <li>GPRS/3G from €0.19/MB or packages with no minimal charge in most countries</li>
                                <li>Send unlimited free SMS from the website to any XXSIM</li>
                                <li>XXSIM to XXSIM calls for €0.19/min only. No matter where the called XXSIM is located</li>
                                <li>Auto reload available for large accounts or public sector</li>
                                <li>No charges for incoming calls in the USA and Canada.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <section class="new-feature-section text-center">
            <div class="container">
                <div class="new-feature-slider">
                  <div class="slide">
                      <h1>New <span>feature</span> just launched!</h1>
                      <p class="big white-color">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s,</p>
                  </div>
                  <div class="slide">
                      <h1>New <span>feature</span> just launched!</h1>
                      <p class="big white-color">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s,</p>
                  </div>
                  <div class="slide">
                      <h1>New <span>feature</span> just launched!</h1>
                      <p class="big white-color">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s,</p>
                  </div>
                </div>
            </div>
        </section>
        <section class="online-shop-section text-center">
            <div class="container">
                <h2><span>Online</span> Shop</h2>
                <p class="big white-color">Click here to order your XXSIM now. <br />Free delivery worldwide!</p>
                <ul class="list-inline">
                    <li><a href="{{ route('online_shop') }}" class="theme-btn">Buy XXSIM Card</a></li>
                    <li><a href="{{ route('online_shop', 'recharge') }}" class="theme-btn inverse">Recharge</a></li>
                </ul>
            </div>
        </section>
        <section class="corporate-account-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-10">
                        <div class="desc">
                            <h3 class="titleh1">Corporate Account</h3>
                            <p class="big">Customized offers for Companies, Organizations, Governments!</p>
                            <p>In some selected countries, you have the possibility to add a national landline number to your XXSIM. Like this you will not only be reachable on your 00372.../0044... number but also on your national landline number (e.g. 0041)... which can even be on display when placing outgoing calls. If your receive a call on your national landline number, your XXSIM account will be charged with &euro;0.15/min.</p>
                            <a href="{{ route('features') }}" class="theme-btn">Features</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="call-rates"></div>
        <section class="call-rates-coverage-section">
            <div >
                <div class="call-rates-block">
                    <h3>call rates</h3>
                    <p class="desc">The best rates in over 190 countries</p>
                    <div class="selection-block">
                        <form>
                            <h5 class="title">ROAMING IN</h5>
                            <select id="from_country" class="custom change-country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                                <!-- <option class="hideme">Select a country</option> -->
                                @foreach($counties as $country)
                                    <option value="{{ $country->country }}" @if($country->country == 'Germany') selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                            <h5 class="title">CALLING TO</h5>
                            <select id="to_country" class="custom change-country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                                <!-- <option class="hideme">Select a country</option> -->
                                @foreach($counties as $country)
                                    <option value="{{ $country->country }}" @if($country->country == 'United Arab Emirates') selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="desc-block">
                        <div class="item">
                            <h5>Price Per Minute <span id="call_price" class="left">{{ '€' . ($rate_data['call_price'] + $rate_data['extra']) }}</span></h5>
                        </div>
                        <div class="item incoming-calls">
                            <h5>Incoming Calls</h5>
                            <ul class="yellow-color">
                                <li>
                                    <span id="lbl_from_country">Germany</span> 
                                    <span id="call_from_price" class="left">{{ !empty($rate_data['call_received_price_from']) ? '€' . $rate_data['call_received_price_from'] : 'free' }}</span>
                                </li>
                                <!-- <li>
                                    <span id="lbl_to_country">United Arab Emirates</span> 
                                    <span id="call_to_price" class="left">{{ !empty($rate_data['call_received_price_to']) ? '€' . $rate_data['call_received_price_to'] : 'free' }}</span>
                                </li> -->
                            </ul>
                        </div>
                        <div class="item">
                            <ul>
                                <li>SMS Rates <span id="sms_price" class="left">{{ !empty($rate_data['sms_price']) ? '€' . $rate_data['sms_price'] : '-' }}</span></li>
                                <li>SMS Through XXSIM <span id="xxsim_sms_price" class="left">{{ !empty($rate_data['xxsim_sms_price']) ? '€' . $rate_data['xxsim_sms_price'] : '-' }}</span></li>
                                <li>MENU or USSD <span class="left"></span></li>
                                <li>GPRS (1MB) <span id="gprs_price" class="left">{{ !empty($rate_data['gprs_price']) ? '€' . $rate_data['gprs_price'] : '-' }}</span></li>
                                <li>XXSIM to XXSIM <span id="xxsim_price" class="left">{{ !empty($rate_data['xxsim_price']) ? '€' . $rate_data['xxsim_price'] : '-' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="space-block">
                </div>
                <div class="coverage-block">
                    <h3>coverage</h3>
                    <!-- <p class="desc">Click on any country to find out what ist coverage is like</p> -->
                    <div class="map-block text-center">
                        <img src="{{ asset('front/images/map.png') }}" alt="map">
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection
@endif


@push('scripts')
<script type="text/javascript">
    $(function(){
        $(".change-country").change(function(){
            var action = "{{ route('change_rate') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                beforeSend: addOverlay,
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    from_country: $('#from_country').val(),
                    to_country: $('#to_country').val()
                },
                success: function(r){
                    if(r.status == 200){
                        var rate_data = r.rate_data;
                        var rate_call_price = (rate_data.call_price == null ? 0 : rate_data.call_price);
                        var rate_extra = (rate_data.extra == null ? 0 : rate_data.extra);
                        $('#call_price').html('€' + (parseFloat(rate_call_price) + parseFloat(rate_extra)));
                        $('#lbl_from_country').html($('#from_country').val());
                        $('#lbl_to_country').html($('#to_country').val());
                        $('#call_from_price').html((rate_data.call_received_price_from == 0.00 || rate_data.call_received_price_from == null) ? 'free' : '€' + rate_data.call_received_price_from);
                        $('#call_to_price').html((rate_data.call_received_price_to == 0.00 || rate_data.call_received_price_to == null) ? 'free' : '€' + rate_data.call_received_price_to);
                        $('#sms_price').html((rate_data.sms_price == 0 || rate_data.sms_price == null) ? '-' : '€' + rate_data.sms_price);
                        $('#xxsim_sms_price').html((rate_data.xxsim_sms_price == 0 || rate_data.xxsim_sms_price == null) ? '-' : '€' + rate_data.xxsim_sms_price);
                        $('#gprs_price ').html((rate_data.gprs_price == 0 || rate_data.gprs_price == null) ? '-' : '€' + rate_data.gprs_price);
                        $('#xxsim_price').html((rate_data.xxsim_price == 0 || rate_data.xxsim_price == null) ? '-' : '€' + rate_data.xxsim_price);
                    }
                    else{
                        showMessage(r.status, r.message);
                    }
                },
                complete: removeOverlay
            });
        });
    });

     $(document).ready(function(){
          $('.new-feature-slider').slick({
            arrows: false,
            dots: true,
          });
        });
        // slider
        $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ]
        });
</script>
@endpush