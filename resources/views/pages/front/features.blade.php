@extends('layouts.app')

@section('banner')
<section class="banner features private-highlight">
    <div class="container">
        <div class="desc">
            <h1>Solutions for Private Customers <br />as well as Business Users, Corporations and Public Sector Customers</h1>
            <p>XXSIM provides solutions for you regardless of whether you buy a single SIM card for your personal use or a thousands SIM cards for people traveling in your company. We offer a full package and the best rates worldwide.</p>
            <ul class="list-inline">
                <li><a href="{{ route('corporate') }}" class="theme-btn outlined">Corporate</a></li>
                <li><a href="{{ route('features') }}" class="theme-btn outlined private">Private</a></li>
            </ul>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <section class="how-does-it-work-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 title-block">
                    <div>
                        <h2 class="titleh1">How does it work to fly so high ?</h2>
                    </div>
                </div>
                <div class="col-sm-6 desc-block">
                    <div>
                        <ul>
                            <li>No monthly charges</li>
                            <li>No roaming charges for incoming calls in approximately 150 countries</li>
                            <li>GPRS/3G from €0.19/MB or packages, no minimal charge in most countries</li>
                            <li>XXSIM card positioning on Google Maps®</li>
                            <li>Calls from XXSIM to XXSIM in a European country to a mobile# or landline# in a European country €0.19/Min only</li>
                            <li>Free call forwarding to any number (including mobile) to avoid usage of a dual SIM phone</li>
                            <li>No charges for incoming calls in the USA and Canada.</li>
                            <li>Free delivery worldwide</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features-full-section">
        <div class="container-fluid">
            <div class="feature feature1">
                <div class="row">
                    <div class="col-sm-6 bg-block">
                        <div>
                            <!-- Use for block height -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="desc">
                            <h3>Switch to XXSIM and enjoy free incoming calls worldwide</h3>
                            <p>When crossing the border, replace your SIM card with an XXSIM and begin enjoying lower rates worldwide. </p>
                            <p>New SIM card means a new number. The base numbers of your XXSIM begins with 00372 the prefixes of Estonia and the UK. Thanks to that, you can enjoy much better rates and free incoming calls in over 150 countries with the same quality. Moreover, XXSIM is constantly negotiating with local operators to get the lowest rates.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature feature2">
                <div class="row">
                    <div class="col-sm-6 col-sm-push-6 col-xs-12 bg-block">
                        <div>
                            <!-- Use for block height -->
                        </div>
                    </div>
                    <div class="col-sm-6 col-sm-pull-6 col-xs-12">
                        <div class="desc">
                            <h3>What if I want to browse the internet and stay connected to social media?</h3>
                            <p>We have you covered with 3G/GPRS starting at €0.19/MB and with a variety of packages that get you even more data. This way you can keep up with your friends and share with them all along your journey without worrying about an astronomical phone bill when you get back home.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature feature3">
                <div class="row">
                    <div class="col-sm-6 bg-block">
                        <div>
                            <!-- Use for block height -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="desc">
                            <h3>And if I want a <br />national landline number?</h3>
                            <p>For some selected countries, you have the possibility to add a national landline number to your XXSIM. Like this you will not only be reachable on your 00372… number but also on your national landline number (I.eg. 0041)… which can even be on display when placing outgoing calls. If you receive a call on your national landline number, your XXSIM account will be charged with €0.15/min.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="order-your-xxsim-section text-center">
        <div class="container">
            <h2>Don't miss this opportunity <br /><span>order your XXSIM Now</span></h2>
            <ul class="list-inline">
                <li><a href="{{ route('online_shop') }}" class="theme-btn">Buy XXSIM Card</a></li>
                <li><a href="{{ route('dashboard.home') }}" class="theme-btn inverse">Recharge</a></li>
            </ul>
        </div>
    </section>
</main>
@endsection