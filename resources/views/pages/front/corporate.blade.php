@extends('layouts.app')

@section('banner')
<section class="banner features corporate-highlight">
    <div class="container">
        <div class="desc">
            <h1>Solutions for Business users <br />as well as Corporations</h1>
            <p>XXSIM provides solutions for you regardless of whether you buy a single SIM card for your personal use or a thousands SIM cards for people traveling in your company. We offer a full package and the best rates worldwide.</p>
            <ul class="list-inline">
                <li><a href="{{ route('corporate') }}" class="theme-btn outlined corporate">Corporate</a></li>
                <li><a href="{{ route('features') }}" class="theme-btn outlined">Private</a></li>
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
                            <li>No roaming charges for incoming calls in approximately 150 countries</li>
                            <li>Outgoing calls approximately 85% cheaper</li>
                            <li>6 ways to call XXSIM for free</li>
                            <li>XXSIM to XXSIM calls for €0.19/min only. No matter where the called XXSIM is located</li>
                            <li>Free call forwarding to any number (including mobile) to avoid usage of a dual SIM phone</li>
                            <li>Autoreload function</li>
                            <li>Free delivery worldwide</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features-full-section corporate">
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
                            <h3>Cut down on your <br/> company’s telecom costs</h3>
                            <p>With XXSIM your team enjoys free incoming calls as well as the best rates on outgoing calls regardless of where they are in the world. You can lower your overhead and implement features such as XXSIM’s free SMS option to make roaming a non-issue.</p>
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
                            <h3>How can XXSIM make <br/> managing reloads easier?</h3>
                            <p>XXSIM comes with an auto reload function that not only ensures your people stay connected at all times, but also lets you monitor how much credit everyone uses and lets you identify any outliers. This feature eliminates the headache of keeping everyone topped-up and instead allocates your budget automatically based on a one-time setup procedure.</p>
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
                            <p>Thanks to the callback system, the rates of incoming and outgoing calls are reduced to a minimum. And this automatic! You just have to dial the number you need and you will be connected within seconds. You can forget the high calling rates from now on, whether you are on vacation or travelling otherwise.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="order-your-xxsim-section text-center">
        <div class="container">
            <h2>Don't miss this opportunity <br /><span>order your XXSIM Now</span></h2>
            {{-- <p class="white-color">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <br />been the industry's standard dummy text ever since the 1500s,</p> --}}
            <ul class="list-inline">
                <li><a href="{{ route('online_shop') }}" class="theme-btn">Buy XXSIM Card</a></li>
                <li><a href="{{ route('dashboard.home') }}" class="theme-btn inverse">Recharge</a></li>
            </ul>
        </div>
    </section>
</main>
@endsection