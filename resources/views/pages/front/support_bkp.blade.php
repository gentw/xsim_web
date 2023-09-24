@extends('layouts.app')

@section('banner')
<section class="banner support text-center">
    <div class="container">
        <div class="desc">
            <h1>Ask us anything, any time</h1>
            <a href="{{ route('user-manual') }}" class="theme-btn yellow-btn">User Manual</a>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <section class="support-content-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 border left-block">
                    <div class="item">
                        <h2>Frequently Asked Questions</h2>
                        <div class="questions-list">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{ route('general-questions') }}">Is your website secured ?</a> <!-- General Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('general-questions') }}">What country code is 0037?</a> <!-- General Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('product-questions') }}">How will a call be charged if a user is calling my number directly +37254XXXXX?</a> <!-- Product Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('product-questions') }}">Is XXSIM designed for companies?</a> <!-- Product Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('product-questions') }}">How can I add a XXSIM to my account?</a> <!-- Product Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('product-questions') }}">Can I call an XXSIM user for free? Yes, you can!</a> <!-- Product Questions -->
                                </li>
                                <li>
                                    <a href="{{ route('first-steps') }}">What is Internet access configuration (GPRS)?</a> <!-- First Steps -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 right-block">
                    <div class="item">
                        <h2>Common Problems</h2>
                        <div class="questions-list">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{ route('troubleshooting') }}">I can‘t register on the website.</a> 
                                </li>
                                <li>
                                    <a href="{{ route('troubleshooting') }}">I have not received the validation email of my record.</a> 
                                </li>
                                <li>
                                    <a href="{{ route('troubleshooting') }}">I cannot activate my XXSIM.</a> 
                                <li>
                                    <a href="{{ route('troubleshooting') }}">It is impossible to make an outgoing call (the incoming calls can be received)</a> 
                                </li>
                                <li>
                                    <a href="{{ route('troubleshooting') }}">I can’t use the internet or synchronize my emails on my mobile phone</a> 
                                </li>
                            </ul>
                        </div> 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    $('.panel-heading a').click(function() {
        $('.panel-default').removeClass('active');
        if(!$(this).closest('.panel').find('.panel-collapse').hasClass('in'))
            $(this).parents('.panel-default').addClass('active');
    });
</script>
@endpush