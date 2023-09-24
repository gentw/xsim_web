@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap-responsive-tabs.css') }}">
@endpush

@section('banner')
<section class="banner quick-start">
    <div class="container">
        <div class="home-intro-container">
            <div class="desc">
                <h1>WELCOME TO  <br/> THE XXSIM WORLD!</h1>
                <p>Read the guide below to set up your new SIM card and get started immediately!</p>
                <ul class="list-inline">
                    <li><a href="{{ route('online_shop') }}" class="theme-btn">Quick Start</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="quick-start">
    <div class="container">
        <div class="quick-start-page">
            <div class="tab-title">
                <ul class="nav nav-tabs responsive-tabs">
                    <li class="active">
                        <a href="#activation" data-toggle="tab">Activation</a>
                    </li>
                    <li>
                        <a href="#calls" data-toggle="tab">Calls</a>
                    </li>
                    <li>
                        <a href="#sms" data-toggle="tab">SMS</a>
                    </li>
                    <li>
                        <a href="#balance" data-toggle="tab">Balance</a>
                    </li>
                    <li>
                        <a href="#commands" data-toggle="tab">Commands</a>
                    </li>
                    <li>
                        <a href="#toll-free-numbers" data-toggle="tab">Toll Free Numbers</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="activation" class="tab-pane fade in active">
                        <h2 class="titleh1">DID YOU ACTIVATE YOUR XXSIM?</h2>
                        <div class="three-column">
                            <div class="col-sm-4">
                                <h2>1. How to validate your account?</h2>
                                <p>By ordering, you filled up a registration form.</p>
                                <p>Then you received an activation link by email to activate your account. If you did not click on the link, please do it now.</p>
                                <p>If you don't find this activation email, please check your spam folder.</p>
                                <p>If you really don't find it, please contact us at support@xxsim.com</p>
                            </div>
                            <div class="col-sm-4">
                                <h2>2. How to add my XXSIM?</h2>
                                <p>Your XXSIM must be linked to your account. To add your XXSIM card to your acccount, please log in onto xxsim.com with your email address and password.</p>
                                <p>Then clickon "My Account", then "Add SIM". Enter your XXSIM phone# 00372xxxxxxx and click on "Add an XXSIM".</p>
                            </div>
                            <div class="col-sm-4">
                                <h2>3. How to activate my XXSIM?</h2>
                                <p>Once you added your XXSIM to your account, insert it in your mobile phone and switch it on (your mobile phone must not be SIMlocked by your network operator). <br/>You'll receiev a 4 digit code by SMS on your XXSIM.</p>
                                <p>Please enter this code into the field on the website (see 2.) and click "Save".</p>
                                <p>Your XXSIM is now linked to your account.</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div id="calls" class="tab-pane fade in">
                        <h2 class="titleh1">Phone calls with XXSIM</h2>
                        <div class="three-column">
                            <div class="col-sm-4">
                                <p>To place a phone call, the process is very easy. XXSIM is based on a callback system, it means that you'll be called back when you place an outgoing call.</p>
                                <p>1. Please dial the number with international format i.eg. 003313245678 or +3312345678, or select a number in your phone's memory (must be stored with internation format).</p>
                                <p>2. You immediately receive a message that indicates that you'll be called back.</p>
                                <p>3. After a couple of seconds, you'll be called back.</p>
                                <p>4. Answer the call, you'll hear the ringtone, the destination number has been called.</p>
                            </div>
                            <div class="col-sm-4">
                                <p>On some older mobile phones it is possible that the callback function will not work. If that is the case, do the following:</p>
                                <p>1. Dial *146* before the number you wish to dial and then press the call button. Eg. *146*003312345678(dial button).</p>
                                <p>2. You will immediately receive a message telling you that you will be called back.</p>
                                <p>3. After 4 seconds your phone will ring.</p>
                                <p>4.Pick up the phone and your communication is established.</p>
                            </div>
                            <div class="col-sm-4">
                                <p>If you have a problem with your smartphone.</p>
                                <p>For Samsung, BlackBerry and iPhone users, or other users that encounter problems while making direct calls: You have to activate the call function CC Option X.</p>
                                <p>Open the section XXSIM in you phone menu > Select Settings > Validate > Dial 1101 > Validate > Validate. To deactivate this function do the same as above: Only replace 1102 with 1101.</p>
                                <p>If you encouter problems in the USA, please apply the same process, but with service code 210 101 to activate US mode and service code 210 100 to deactivate it.</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div id="sms" class="tab-pane fade in">
                        <h2 class="titleh1">How to send and receive SMS with XXSIM?</h2>
                        <div class="three-column">
                            <h2 class="titleh1">XXSIM SENDS AND RECEIVES <br/>SMS LIKE ANY OTHER SIM CARD.</h2>
                            <p>It's not necessary to configure your mobile, the SMS center (+3725099000) will be send by the network.</p>
                        </div>
                    </div>
                    <div id="balance" class="tab-pane fade in">
                        <h2 class="titleh1">How to manage your XXSIM?</h2>
                        <div class="three-column">
                            <div class="col-sm-4">
                                <h2>How to check <br/>your balance?</h2>
                                <p>To check the balance, please dial *146*099# and press the "Send" key. The balance will appear on the display.</p>
                            </div>
                            <div class="col-sm-4">
                                <h2>How to reload <br/>your XXSIM?</h2>
                                <p>To check the balance, please dial *146*099# and press the "Send" key. The balance will appear on the display.</p>
                            </div>
                            <div class="col-sm-4">
                                <h2>Add credit <br/>by PIN code </h2>
                                <p>To check the balance, please dial *146*099# and press the "Send" key. The balance will appear on the display.</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div id="commands" class="tab-pane fade in">
                        <h2 class="titleh1">XXSIM Menu and additional features</h2>
                        <div class="three-column">
                            <h2>An application menu XXSIM is available in your phone, and includes the following features:</h2>
                            <p>Call - sends a call (if your phone is not compatible with direct calls)</p>
                            <p>Send SMS - To send an SMS in Europe at EUR0.11 in Europe</p>
                            <p>Voicemail - Calls the voicemail, if active</p>
                            <p>Check balance - shows the actual balance</p>
                            <p>Add credit - see info about PIN codes</p>
                            <p>Customer care - Calls the support</p>
                            <p>Extras - this feature is not active</p>
                            <p>Settings - special features (only on technical support's request)</p><br/>
                            <h2>USSD commands:</h2>
                            <div class="col-sm-6">
                                <p>*146*number with international prefix# <br/>Call, i. eg.: *146*003312345678#</p>
                                <p>*146*099# <br/>Check balance and display XXSIM phone#</p>
                                <p>*146*091# (default) <br/>Activate voice mailbox</p>
                                <p>*146*090# <br/>Deactivate voice mailbox</p>
                                <p>*146*094# <br/>Quick Check voice mailbox</p>
                                <p>*146*095# <br/>Voice mailbox menu</p>
                            </div>
                            <div class="col-sm-6">
                                <p>*146*081*number with international prefix# <br/>Permanent call divert, i. eg.: *146*081*0041900444445#</p>
                                <p>*146*080# <br/>Deactivate call divert</p>
                                <p>*146*301# (default if no national DID has been activated) <br/>Set Caller ID (CLI) = Base number 00372…</p>
                                <p>*146*302# (default if a national DID has been activated) <br/>Set Caller ID (CLI) = First national number selected</p>
                                <p>*146*311# (default) <br/>Activate caller ID (CLI)</p>
                                <p>*146*310# Deactivate caller ID (CLI), some network operators will ignore this selection and always display the CLI</p>
                                <p>*146*300# <br/>Check caller ID (CLI) status</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <p>*146*0891# <br/>Activate/deactivate SMS warning at 80% GPRS limit</p>
                                <p>*146*0891*limit# <br/>Set new GPRS limit value</p>
                                <p>*146*711# (default) <br/>Activate calls from Skype</p>
                                <p>*146*710# <br/>Deactivate calls from Skype</p>
                                <p>*146*712# <br/>Check "calls from Skype" status</p>
                                <p>*146*781# (default) <br/>Activate calls from Webcall</p>
                                <p>*146*780# <br/>Deactivate calls from Webcall</p>
                                <p>*146*782# <br/>Check "calls from Webcall" status</p>
                            </div>
                            <div class="col-sm-6">
                                <p>*146*097XYnnnnnnnnnnnn*SMStext# (only if your phone allows you to type text) <br/>Send SMS by USSD from all countries at EU rate. X=Number of this part of the message, Y=Number of parts, nnnnnnnnnnnnn=phone# beginning by 00</p>
                                <p>*146*941*1# <br/>Activate Data package 10MB for EUR1.5 in max 24 hours</p>
                                <p>*146*940*1# <br/>Deactivate Data package 10MB for EUR1.5 in max 24 hours</p>
                                <p>*146*942*1# <br/>Check status for "Data package 10MB for EUR1.5 in max 24 hours"</p>
                                <p>Available in following countries: Austria, Belgium, Bulgaria, Croatia, Cyprus, Czech Republic, Denmark, Estonia, Finland, France, Germany, Greece, Hungary, Iceland, Ireland, Italy, Latvia, Lithuania, Luxembourg, Malta, Monaco, Netherlands, Norway, Poland, Portugal, Romania, Russia, Slovakia, Slovenia, Spain, Saint-Barthelemy, Sweden and United Kingdom.</p>
                                <p>The package can be reactivated after 24 hours, or as soon as the 10MB have been used. </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div id="toll-free-numbers" class="tab-pane fade in">
                        <h2 class="titleh1">Your XXSIM can be called for free</h2>
                        <div class="three-column">
                            <h2>Your XXSIM can be called for free <br/>From selected counties, it possible to call an XXSIM for free by calling a toll free number.*</h2>
                            <p>Your XXSIM can be called for free <br/>From selected counties, it possible to call an XXSIM for free by calling a toll free number.* <br/>A caller located in the USA can call an XXSIM located in the UAE for free by calling the toll freee number in the USA. The call ist free for the caller.</p><br/>
                            <h2>Here the list of toll free numbers by country. You can give these to your family, <br/>friends and other contacts to allow them to call you for free.</h2>
                            <div class="col-sm-6">
                                <p>Australia : 1800424087 or 1800426571 </p>
                                <p>Austria : 0800295331 </p>
                                <p>Brazil : 08000385084 </p>
                                <p>Canada : 18889354312 </p>
                                <p>Cyprus : 80096439 </p>
                                <p>France : 0800910659 </p>
                                <p>Germany : 08001824205 </p>
                                <p>Greece : 0080016122057807 </p>
                                <p>Hong Kong : 800967359</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Israel : 1809246071 </p>
                                <p>Mexico City : 525547772326 </p>
                                <p>New Zealand : 0800449302 </p>
                                <p>Russia : 81080028741012 </p>
                                <p>Spain : 900967051 </p>
                                <p>Switzerland : 0800802452 </p>
                                <p>United Arab Emirates : coming soon </p>
                                <p>USA : 18889354312</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</section>
@endsection

@push('page_js')
 <!-- Extra Javascript -->
    <script src="{{ asset('front/js/bootstrap-responsive-tabs.min.js') }}" type="text/javascript"></script>
@endpush

@push('scripts')
<script>
    $('.responsive-tabs').responsiveTabs({
    accordionOn: ['xs', 'sm'] // xs, sm, md, lg 
    });
</script>
@endpush