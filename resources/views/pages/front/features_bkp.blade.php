@extends('layouts.app')

@section('banner')
<section class="banner features">
    <div class="container">
        <div class="desc">
            <h1>Solutions for Private Users <br />as well as Corporations (Private users by default)</h1>
            <p>XXSIM provides solutions for you regardless of whether you buy a single SIM card for your personal use or a hundred SIM cards for people traveling in your company. We offer a full package and the best rates worldwide.</p>
            <ul class="list-inline">
                <li><a href="{{ route('corporate') }}" class="theme-btn outlined">Corporate</a></li>
                <li><a href="{{ route('private') }}" class="theme-btn outlined">Private</a></li>
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
                        <h1>How does it work to fly so high ?</h1>
                    </div>
                </div>
                <div class="col-sm-6 desc-block">
                    <div>
                        <ul>
                            <li>Free incoming calls in over 149 countries</li>
                            <li>Up to 90% cheaper for outgoing calls </li>
                            <li>Free SMS to any XXSIM from the website</li>
                            <li>GPRS Data much cheaper, no minimum invoiced amount</li>
                            <li>Same quality</li>
                            <li>You control the expenses with the Prepaid system</li>
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
                            <h3>Switch to XXSIM and enjoy <br />free incoming calls worldwide</h3>
                            <p>When crossing the border, replace your SIM card with XXSIM and begin enjoying the lower rates worldwide. <br /> New SIM card means a new number. The number of your XXSIM begins with 00372, the prefix of Estonia. Thanks to that, you can enjoy much better rates and free incoming calls in over 150 countries with the same quality. Moreover, XXSIM is constantly negotiating with the local operators to get the lowest rates.</p>
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
                            <h3>And if I want a national <br />landline number?</h3>
                            <p>In some selected countries, you have the possibility to add a national landline number to your XXSIM. Like this you will not only be reacheable on your 00372… number but also on your national landline number (I.eg. 0041)… which will be on display when placing outgoing calls. If you receive a call on your national landline number, your XXSIM account will be charged with EUR0.15/min.</p>
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
                            <h3>Call more <br />and pay less!</h3>
                            <p>Thanks to the callback system, the rates of incoming and outgoing calls are reduced to a minimum. And this automatic! You just have to dial the number you need and you will be connected within seconds. You can forget the high phone rates from now on, whether you are on vacation or travelling otherwise.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="order-your-xxsim-section text-center">
        <div class="container">
            <h2>Don't miss this opportunity <br /><span>order your XXSIM Now</span></h2>
            <!-- <p class="white-color">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s,</p> -->
            <ul class="list-inline">
                <li><a href="{{ route('online_shop') }}" class="theme-btn">Buy XXSIM Card</a></li>
                <li><a href="{{ route('online_shop', 'recharge') }}" class="theme-btn inverse">Recharge</a></li>
            </ul>
        </div>
    </section>
</main>
@endsection