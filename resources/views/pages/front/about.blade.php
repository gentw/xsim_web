@extends('layouts.app')

@section('banner')
<section class="banner about">
    <div class="container">
        <div class="desc">
            <h1>About XXSIM International SIM CARD</h1>
            <p>XXSIM has been active for more than 8 years worldwide and provides innovative new products and services that make using your mobile phone easier and less expensive while traveling to the world. Thus, XXSIM is a SIM card allow travelers to use their mobile phones abroad at a fraction of the usual price.</p>
            <a href="{{ route('online_shop') }}" class="theme-btn outlined">Get the XXSIM</a>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <section class="about-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <h2 class="titleh1">All information <br />about XXSIM</h2>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-md-6 col-md-offset-1 col-sm-7">
                    <p class="contact-desc"> XXSIM is a trademark of Egraphic DMCC, a limited company, located at the following address:<br />
                        Egraphic DMCC <br />
                        Tiffany Tower, Cluster W, JLT <br />
                        Office 1406 <br />
                        Dubai, UAE 
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="full-desc">
                <p>The ambition of XXSIM is to create a service that allows you to use your mobile phone anywhere in the world and for as long as you want without worrying about the price. Mobile phones and the Internet have become essential tools for keeping in touch with your family and friends every day. XXSIM ensures the use of these tools without fear of having exorbitant mobile phone bills. <br />
                XXSIM travel SIM card provides telecommunications services to thousands of individuals across the globe through various strategic partnerships with more than 650 global networks in more than 190 countries. The XXSIM card can be used in any standard GSM phone, smartphone or broadband modem. XXSIM customers use all their mobile phones worldwide for a fraction of the usual price. In addition to offering the most cost-effective way for voice communications, SMS and data download abroad, XXSIM offers other features that include: <br /><br /> 
                Value: You get free calls in most countries or an unrivaled price when you make a call from abroad, text or access the Internet from the USA, Europe or anywhere in the world . The XXSIM service operates in more than 190 countries. XXSIM also offers special solutions tailored to customer needs (micro SIM, Corporate Account). <br /><br /> 
                Transparency: No contract, no commitment, no bills. There are no minimum connection fees or minimum daily packages. There are no additional hidden fees. XXSIM is a totally transparent service. Our prices are easy to understand and the history of your XXSIM allows you to see exactly how much you spend and which service (s) you use. You can check the cost of the last call, the cost of the last Internet session or the last SMS sent. You are now certain to master your mobile phone costs when traveling abroad. <br /><br /> 
                Convenience: The XXSIM international travel SIM card is designed so that calls from your mobile phone and mobile internet work in the same familiar way at home and when you travel. You do not have to worry about special commands, new menus, special characters or unusual prefixes. All you have to do is make and receive calls, send text messages and surf the web as you did so far. It's easy to order your new XXSIM card online. Once registered, you create an account that allows you to have a total overview of your services (XXSIM card balance, your card history for calls.</p>
            </div>
        </div>
    </section>
    <section class="order-your-xxsim-section text-center">
        <div class="container">
            <h2>Don't miss this opportunity <br /><span>order your XXSIM Now</span></h2>
            <ul class="list-inline">
                <li><a href="{{ route('online_shop') }}" class="theme-btn">Buy XXSIM Card</a></li>
                <li><a href="{{ route('online_shop', 'recharge') }}" class="theme-btn inverse">Recharge</a></li>
            </ul>
        </div>
    </section>
</main>
@endsection