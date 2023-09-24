@extends('layouts.app')

@section('banner')
<section class="banner home become-reseller reseller">
    <video autoplay muted loop>
        <source src="{{ asset('public/front/video/reseller-video.mp4') }}" type="video/mp4">
    </video>
    <div class="container">
        <div class="desc">
            <div class="row">
                <div class="col-sm-8">
                    <h1>Become <br /> <span>an XXSIM Reseller</span></h1>
                    <p class="bold">The XXSIM reseller program is for partners who want to buy our products and resell them to their clients.</p>
                    <p> This program is flexible for the specific needs of each of our partners in different spheres of the market. We would be glad to discuss the options with you in detail and thereby create an individual solution for you and your needs.</p>
                    <p> Conntact us if you want to know more or become an XXSIM reseller.</p>
                    <a href="mailto:info@xxsim.com" class="theme-btn outlined-inverse">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <div class="entrepreneurs common-spacing">
        <img class="visible-xs" src="{{ asset('front/images/entrepreneur.jpg') }}">
        <div class="container">
            <div class="col-sm-6">
                <h3><span>XXSIM</span> for Entrepreneurs and Business Owners</h3>
                <p>Whether you’re a budding entrepreneur or a business owner who wish to take your company to the next level, XXSIM offers you a cost-effective solution that will help your business grow. Our team believes in constant growth and is dedicated to provide you with a reliable support to make sure that your business realizes its full potential.</p>
                <p>The telecommunications industry is a continuously-evolving sector and XXSIM has been adapting to latest market trends with its innovative products and services so that our partners can benefit from our updated offerings. Over the years, XXSIM has developed hundreds of partnerships across the globe. XXSIM’s flexible product offerings has created a pool of partners in the field of Logistics, Travel Industry, GSM, and iOT devices worldwide. Join XXSIM’s growing network worldwide and help us reinvent global communication.  </p>
            </div>
        </div>
    </div>
    <div class="benefits-to-you common-spacing">
        <div class="container">
            <div class="benefits-to-you-inner">
                <h2>Benefits to You</h2>
                <p>Whether you’re a budding entrepreneur or a business owner who wish to take your company to the next level, XXSIM offers you a cost-effective solution that will help your business grow. </p>
            </div>
            <div class="benefits-features">
                <ul>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/money.png') }}');"></span>
                        <p>Earn up to 50% margin</p>
                    </li>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/lounch.png') }}');"></span>
                        <p>No minimum set-up cost.</p>
                    </li>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/percentage.png') }}');"></span>
                        <p>Affordable retail price.</p>
                    </li>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/web.png') }}');"></span>
                        <p>Global distribution opportunities.</p>
                    </li>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/handshak.png') }}');"></span>
                        <p>Reliable support</p>
                    </li>
                    <li>
                        <span style="background-image: url('{{ asset('front/images/bag.png') }}');"></span>
                        <p>Flexible Offers</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="partners-with-us common-spacing">
        <div class="container">
            <h3>How can you <br/>partner with XXSIM?</h3>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 partners-inner text-center">
                    <img src="{{ asset('front/images/partners-img.png') }}">
                    <h3>Reseller Programme</h3>
                    <p>The XXSIM reseller program is for partners who want to buy our products and resell them to their clients.</p>
                    <p>This program is flexible for the specific needs of each of our partners in different spheres of the market. We would be glad to discuss the options with you in detail and thereby create an individual solution for you and your needs.</p>
                    <p>Contact us if you want to know more or become an XXSIM reseller.</p>
                    <a href="#" class="theme-btn outlined-inverse">Become a Reseller</a>
                </div>
                <div class="col-sm-6 partners-inner text-center">
                    <img src="{{ asset('front/images/partners-img2.png') }}">
                    <h3>Become an Affiliate</h3>
                    <p>Sign up as an XXSIM Affiliate and start earning commissions on successful leads! At XXSIM, we work closely to provide our clients with a wide variety of products designed specifically for travelers and business travelers.</p>
                   {{--  <p>This program is flexible for the specific needs of each of our partners in different spheres of the market. We would be glad to discuss the options with you in detail and thereby create an individual solution for you and your needs.</p>
                    <p>Contact us if you want to know more or become an XXSIM reseller.</p> --}}
                    <a href="mailto:info@xxsim.com" class="theme-btn outlined-inverse">Become an Affiliate</a>
                </div>
            </div>
        </div>    
    </div>
</main>
@endsection