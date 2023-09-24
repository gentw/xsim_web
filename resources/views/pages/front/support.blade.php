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
                        <div class="panel-group" id="accordion-faq">
                            <div class="panel panel-default active">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse1">What is XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">XXSIM is the best roaming solution ever, providing free received calls in more than 134 countries. We target business travellers, nomad people and private people who leave their countries at least once a year, for vacations, for work or for visiting the family. It's a SIM card that will replace your local SIM card when you are abroad.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse2">Where can I buy XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">You can buy XXSIM online as well as from one of our partners worldwide.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse3">What is the price for an XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">The XXSIM Card comes in a 3-in-1 SIM format for EUR 12.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse4">How much are the shipping fees?</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">We offer free shipping worldwide.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse5">Are you shipping worldwide ?</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">Yes, we are shipping worldwide.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse6">How can I pay ?</a>
                                    </h4>
                                </div>
                                <div id="collapse6" class="panel-collapse collapse">
                                    <div class="panel-body">We have three different payment methods on our website: Visa, Mastercard and PayPal.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse7">Is your website secured ?</a>
                                    </h4>
                                </div>
                                <div id="collapse7" class="panel-collapse collapse">
                                    <div class="panel-body">Yes, we use the Secure 256 bit SSL technology, also used by banks worldwide to secure transactions on their websites.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse8">How long will it take to receive my XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse8" class="panel-collapse collapse">
                                    <div class="panel-body">Your XXSIM will be sent by a priority universal postal service within 24 hours (excluding week-ends and public holidays). It can take 1 to 7 working days depending on the destination.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse10">Why do I have to pay for the support?</a>
                                    </h4>
                                </div>
                                <div id="collapse10" class="panel-collapse collapse">
                                    <div class="panel-body">Because we offer an online support for free by email. We detected that people usually call for questions already posted in the FAQ... If you call us, because you are in a critical situation, we'll call you back to solve the problem.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse11">Is it possible to open a SIP trunk on request?</a>
                                    </h4>
                                </div>
                                <div id="collapse11" class="panel-collapse collapse">
                                    <div class="panel-body">For large companies, organizations and public sector customers, it’s possible to open a SIP trunk on your PBX on request. The calls to XXSIM are free. Please contact us. When receiving a call through a SIP trunk, EUR0.15/min will be charged from the XXSIM balance</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse12">Will XXSIM work with a SIMlocked phone?</a>
                                    </h4>
                                </div>
                                <div id="collapse12" class="panel-collapse collapse">
                                    <div class="panel-body">No. Please call you network operator, and ask him to provide the unlock code. As soon as the phone is unlocked, your XXSIM will be accepted.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse13">Can I keep my current phone number on XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse13" class="panel-collapse collapse">
                                    <div class="panel-body">No, you get a new number with the XXSIM card.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse14">Am I able to add a fixed number on my XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse14" class="panel-collapse collapse">
                                    <div class="panel-body">For some countries, you now have the possibility to add a national number to your XXSIM (My account > Buy a national number). This means that your XXSIM can be reached by its regular number 00372… and by the national number. An XXSIM can have one national number only. As soon as a national number has been added, the national number will be shown for outgoing calls. The calls to the national numbers are invoiced by your operator (most of the numbers are landlines). When receiving a call through a national number, EUR0.15/min will be charged from the XXSIM balance</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse15">What country code is 0037?</a>
                                    </h4>
                                </div>
                                <div id="collapse15" class="panel-collapse collapse">
                                    <div class="panel-body">00372 is the country code of Estonia. It’s a small country with only 1.3 million inhabitants but a member of the European Union and one of the most wired and high-tech provided societies in the world! Mobile phone payments for parking fees have been commonplace for ten years. Skype was even invented by Estonian developers. Over 95% of the population uses internet banking, medicine prescriptions are completed electronically and voting is done over the web using a unique digital ID card system, which allows even legal documents to be signed using mobile phone based ID.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse16">Can I synchronize my emails with XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse16" class="panel-collapse collapse">
                                    <div class="panel-body">Of course you can. And at a fraction of the cost, eg. in all European countries, you’ll pay EUR0.5/MB.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse17">You can surf the Internet with XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse17" class="panel-collapse collapse">
                                    <div class="panel-body">Yes, you can surf the Internet with XXSIM. Look on the XXSIM website where you will find a current price list.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse18">Is it possible to know the position of a XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse18" class="panel-collapse collapse">
                                    <div class="panel-body">The SIM-card position function in My Account lets you locate your XXSIM on Google Maps up to 100 times a calendar month (100 times during the month. It is possible to activate the feature several times during the same month). This feature costs EUR1/Month.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse19">How can people reach me on my XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse19" class="panel-collapse collapse">
                                    <div class="panel-body">There are different ways to be reached on your XXSIM:
                                        Call divert: You can divert your office or mobile phone#. In that case, you'll pay the communication from your office or mobile to your XXSIM (EU mobile destination). If you have a flat rate to all EU numbers, it will cost you nothing. You will not pay for received calls if you are in a country that provides free received calls.
                                        Voice mailbox: You can use a recorded message on your office or mobile phone# to provide your XXSIM number. The caller will pay the call to an EU mobile destination. You will not pay for received calls if you are in a country that provides free received calls.
                                        Toll free number: The caller can dial a toll free number if available in his country (see user manual), and compose your XXSIM phone# to call you for free. In that case, you will be charged with the ammount of EUR0.15/min only, even if you are in a country that provides free received calls.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse20">How will a call be charged if a user is calling my number directly +37254XXXXX?</a>
                                    </h4>
                                </div>
                                <div id="collapse20" class="panel-collapse collapse">
                                    <div class="panel-body">The call of a 00372 number will be charged by the provider of the person who calls. The prices start from 0€ with a flatrate, otherwise the rates are approx. 0.11€ up to 0.35€ if the call was made through a landline.
                                    We recommend to tell the caller that toll free green numbers are available in 17 countries. If a call is placed using a toll free number, the caller will be asked to type in the no +372XXXXX, follow by the # button.
                                    It is possible to automate the toll free calls by storing it in the contacts of your mobile phone. An example of a phone book entry could be the number 003725460100: 0800xxxxxx, 0037254601000. With some mobile phones the comma will be replaced by "w".</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse21">How will an incoming call be factured to the XXSIM user?</a>
                                    </h4>
                                </div>
                                <div id="collapse21" class="panel-collapse collapse">
                                    <div class="panel-body">In 124 countries incoming calls for 00372 numbers are always free of charge. It does not matter where the caller currently is located.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse22">How can I check the rest of my cell balance?</a>
                                    </h4>
                                </div>
                                <div id="collapse22" class="panel-collapse collapse">
                                    <div class="panel-body">Several variants are possible depending on the model of your phone:
                                        Dial 099; push the "call" key.
                                        Choose "check balance" from the XXSIM menu.
                                        Dial *146*099#.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse23">Is XXSIM designed for companies?</a>
                                    </h4>
                                </div>
                                <div id="collapse23" class="panel-collapse collapse">
                                    <div class="panel-body">Yes, of course, XXSIM is the best roaming SIM card for business use. Companies will not have to use our website to buy and activate XXSIM in quantity. Please send your request by email: info@xxsim.com, we'll contact you asap.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse39">How to make a call with my XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse39" class="panel-collapse collapse">
                                    <div class="panel-body"><p>The procedure to make calls from your XXSIM is very simple and the same in the whole world. XXSIM works with a callback function that is used when making calls. </p>
                                        <ul class="list-unstyled faq-inner-list">
                                            <li>
                                                <p>Always dial the wished number in the international format, eg. 003312345678 or +3312345678, or dial the number saved in your phone memory. Note: You have to save the numbers you need in the international format.</p>
                                            </li>
                                            <li>
                                                <p>You will then immediately receive a message telling you that you will be called back.</p>
                                            </li>
                                            <li>
                                                <p>After 4 seconds your phone will ring.</p>
                                            </li>
                                            <li>
                                                <p>Pick up the phone and your communication is established. </p>
                                            </li>
                                        </ul>
                                        <p>On some older mobile phones it is possible that the callback function will not work. If that is the case, do the following: </p>
                                        <ul class="list-unstyled faq-inner-list">
                                            <li>
                                                <p>Dial *146* before the number you wish to dial and then press the call button. Eg. *146*003312345678#(dial button).</p>
                                            </li>
                                            <li>
                                                <p>You will immediately receive a message telling you that you will be called back.</p>
                                            </li>
                                            <li>
                                                <p>After 4 seconds your phone will ring.</p>
                                            </li>
                                            <li>
                                                <p>Pick up the phone and your communication is established. </p>
                                            </li>
                                        </ul>
                                        <p> Note: For Samsung, BlackBerry and iPhone users, or r other users that encounter problems while making direct calls: You have to deactivate the call function CC Option X. Open the section XXSIM in you phone menu > Select Settings > Validate > Dial 1101 > Validate > Validate. To deactivate this function do the same as above: Only replace 1101 with 1102.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse40">How do I send or receive SMS?</a>
                                    </h4>
                                </div>
                                <div id="collapse40" class="panel-collapse collapse">
                                    <div class="panel-body">Your XXSIM card receives and sends text messages like any other SIM card. No configuration is neccessary because the number of the messaging center +372509900 will be sent to your phone by the network providers.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse41">How can I control my credit balance?</a>
                                    </h4>
                                </div>
                                <div id="collapse41" class="panel-collapse collapse">
                                    <div class="panel-body">In order to check your credit balance dial *146*099# and press call.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse42">How do I call an XXSIM user for free? Yes, you can!</a>
                                    </h4>
                                </div>
                                <div id="collapse42" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>From the below countries, it's possible to call any XXSIM for free, using a toll free phone#. No matter where the XXSIM is located. When receiving a toll free call, EUR0.15/minute will be charged from the XXSIM balance, and the caller ID will be prefixed by 999.
                                        Example: A caller from the USA calls a mobile located in the United Arab Emirates, he dials the toll free phone# in the USA, then he composes the phone# of the XXSIM and the entire communications only costs EUR0.15/minute. </p>

                                       <p> List of toll free phone#: </p>
                                        <ul class="list-unstyled faq-inner-list">
                                            <li><p>Australia : 1800424087 or 1800426571</p></li>
                                            <li><p>Austria : 0800295331</p></li>
                                            <li><p>Brazil : 08000385084</p></li>
                                            <li><p>Canada : 18889354312</p></li>
                                            <li><p>Cyprus : 80096439</p></li>
                                            <li><p>France : 0800910659</p></li>
                                            <li><p>Germany : 08001824205</p></li>
                                            <li><p>Greece : 0080016122057807</p></li>
                                            <li><p>Hong Kong : 800967359</p></li>
                                            <li><p>Israel : 1809246071</p></li>
                                            <li><p>Mexico City : 525547772326</p></li>
                                            <li><p>New Zealand : 0800449302</p></li>
                                            <li><p>Russia : 81080028741012</p></li>
                                            <li><p>Spain : 900967051</p></li>
                                            <li><p>Switzerland : 0800802452</p></li>
                                            <li><p>United Arab Emirates : coming soon</p></li>
                                            <li><p>USA : 18889354312</p></li>
                                        </ul>
                                        
                                        <p>XXSIM and Skype offer you to provide free calls from Skype to XXSIM.</p>

                                       <p> Activate/Deactivate<br/>
                                        To activate this feature for your XXSIM, dial *146*711#
                                        To deactivate, dial *146*710#
                                        To check the status, dial *146*712#</p>

                                       <p> How to use<br/>
                                        When the feature is activated, Skype users can call your TravelSim number for free using special dialing format +372800XXXXXXXX, where XXXXXXXX is a TravelSim number without the prefix 372.</p>

                                       <p> Cost<br/>
                                        The call is free for the Skype caller. The cost of the incoming call for the XXSIM user is the incoming call rate in the host country plus EUR0.15/min. In case the TravelSim user is in a country with free incoming calls, the cost will be just EUR0.15 per minute.
                                        Example
                                        E.g. to call XXSIM# +37254601111 for free from Skype, you should dial +37280054601111. For the Skype user the call is free. If the XXSIM user is in Russia (free incoming calls) and accepts the Skype call, he pays just EUR0.15/min.</p>

                                       <p> XXSIM and Viber have forged a unique partnership in order to provide free calls from Viber to all XXSIM numbers!</p>

                                       <p> How<br/>
                                        When the feature is activated, Viber users can call XXSIM numbers for free using special dialing format +372800XXXXXXXX, where XXXXXXXX is a XXSIM number. Contact XXSIM Support to activate this feature for your XXSIM!</p>

                                        <p>Cost<br/>
                                        The call is free for Viber user. The cost of incoming Viber call for XXSIM user is incoming call rate in the host country plus 0.15EUR per minute. In case XXSIM user is in the country with free incoming calls, the cost will be just 0.15EUR per minute!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse43">How call I call an other XXSIM for free?</a>
                                    </h4>
                                </div>
                                <div id="collapse43" class="panel-collapse collapse">
                                    <div class="panel-body">After dialing the national prefix you can call any XXSIM for free if you use the green number. It does not matter in which country the other XXSIM is. When making a free call with the green number, EUR0.15/min will be charged to the other XXSIM and the caller number will be displayed with the prefix 999. Eg. Someone in the US wants to call another XXSIM in the United Arab Emirates. If he/she uses the green number, the call will be charged to the call recipient who will have tp pay EUR0.15/min. The caller in the US will not be charged for the call.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse44">How do I reload my XXSIM?</a>
                                    </h4>
                                </div>
                                <div id="collapse44" class="panel-collapse collapse">
                                    <div class="panel-body">Log in at http://www.xxsim.com and use the Reload function.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse45">What is the SIM-card Position Function in My Account?</a>
                                    </h4>
                                </div>
                                <div id="collapse45" class="panel-collapse collapse">
                                    <div class="panel-body">The SIM-card Position Function in My Account lets you locate your XXSIM on Google Maps up to 100 times in a month (It is possible to activate the feature several times during the same month). This feature costs EUR1/Month.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse46">What is Internet access configuration (GPRS)?</a>
                                    </h4>
                                </div>
                                <div id="collapse46" class="panel-collapse collapse">
                                    <div class="panel-body">To use internet with your XXSIM, you have to configurate the access point in your phone:
                                    APN: send.ee
                                    Username: Your XXSIM phone# without 00, i. eg. 37212345678
                                    Password: empty
                                    Easy internet configuration: http://www.msettings.net/</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse47">What is the XXSIM menu for?</a>
                                    </h4>
                                </div>
                                <div id="collapse47" class="panel-collapse collapse">
                                    <div class="panel-body">Your phone menu is now extended by an XXSIM section.
                                        Address book: allows you to call phone # in your phone's memory (in case of phone incompatibility with direct call).
                                        Call: Place a call (in case of phone incompatibility with direct call).
                                        Send SMS: Allows sending discount SMS for EUR0.08 in Europe.
                                        Voicemail: To call the voice mailbox (when activated).
                                        Check balance: To check the XXSIM credit balance.
                                        Add credit : Inactive feature
                                        Customer care: To call the customer care.
                                        Extras : Inactive feature
                                        Settings : Special features (only on technical staff's request)</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" data-target="#collapse48">List of commands:</a>
                                    </h4>
                                </div>
                                <div id="collapse48" class="panel-collapse collapse">
                                    <div class="panel-body"> <div class="table-responsive">
                            <table style="width: 100%; border: 0;">
                                <tbody>
                                    <tr>
                                        <td>*146*number with international prefix#</td><td>Call, i. eg.: *146*003312345678#</td>
                                    </tr>
                                    <tr>
                                        <td>*146*099#</td><td>Check balance and display XXSIM phone#</td>
                                    </tr>
                                    <tr>
                                        <td>*146*091# (default)</td><td>Activate voice mailbox</td>
                                    </tr>
                                    <tr>
                                        <td>*146*090#</td><td>Deactivate voice mailbox</td>
                                    </tr>
                                    <tr>
                                        <td>*146*094#</td><td>Quick Check voice mailbox</td>
                                    </tr>
                                    <tr>
                                        <td>*146*095#</td><td>Voice mailbox menu</td>
                                    </tr>
                                    <tr>
                                        <td>*146*081*number with international prefix#</td><td>Permanent call divert, i. eg.: *146*081*0041900444445#</td>
                                    </tr>
                                    <tr>
                                        <td>*146*080#</td><td>Deactivate call divert</td>
                                    </tr>
                                    <tr>
                                        <td>*146*301# (default if no national DID has been activated)</td><td style="vertical-align: top;">Set Caller ID (CLI) = Base number 00372…</td>
                                    </tr>
                                    <tr>
                                        <td>*146*302# default if a national DID has been activated)</td><td style="vertical-align: top;">Set Caller ID (CLI) = First national number selected</td>
                                    </tr>
                                    <tr>
                                        <td>*146*311# (default)</td><td>Activate caller ID (CLI)</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">*146*310#</td><td>Deactivate caller ID (CLI), some network operators will ignore this selection and always display the CLI</td>
                                    </tr>
                                    <tr>
                                        <td>*146*300#</td><td>Check caller ID (CLI) status</td>
                                    </tr>
                                    <tr>
                                        <td>*146*098*PIN#</td><td>Add credit by PIN code (only available in selected countries)</td>
                                    </tr>
                                    <tr>
                                        <td>*146*0891#</td><td>Activate/deactivate SMS warning at 80% GPRS limit</td>
                                    </tr>
                                    <tr>
                                        <td>*146*0891*limit#</td><td>Set new GPRS limit value</td>
                                    </tr>
                                    <tr>
                                        <td>*146*711# (default)</td><td>Activate calls from Skype</td>
                                    </tr>
                                    <tr>
                                        <td>*146*710#</td><td>Deactivate calls from Skype</td>
                                    </tr>
                                    <tr>
                                        <td>*146*712#</td><td>Check "calls from Skype" status</td>
                                    </tr>
                                    <tr>
                                        <td>*146*781# (default)</td><td>Activate calls from Webcall</td>
                                    </tr>
                                    <tr>
                                        <td>*146*780#</td><td>Deactivate calls from Webcall</td>
                                    </tr>
                                    <tr>
                                        <td>*146*782#</td><td>Check "calls from Webcall" status</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">*146*097XYnnnnnnnnnnnn*SMStext# (only if your phone allows you to type text)</td><td>Send SMS by USSD from all countries at EU rate. X=Number of this part of the message, Y=Number of parts, nnnnnnnnnnnnn=phone# beginning by 00</td>
                                    </tr>
                                    <tr>
                                        <td>*146*941*Package code#</td><td>Activate Data Zone</td>
                                    </tr>
                                    <tr>
                                        <td>*146*940*Package code#</td><td>Deactivate Data Zone</td>
                                    </tr>
                                    <tr>
                                        <td>*146*942#</td><td>Check status Data Zone</td>
                                    </tr>
                                    <?php /*<tr>
                                        <td>*146*942*Package code#</td><td>Check status Data Zone</td>
                                    </tr>
                                    <tr>
                                        <td>Zone A*</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 1, Code 13</td><td>10MB, 1 day, EUR0.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2, Code 14</td><td>50MB, 1 day, EUR2.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3, Code 15</td><td>150MB, 7 days, EUR5.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4, Code 16</td><td>250MB, 14 days, EUR8.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5, Code 17</td><td>500MB, 30 days, EUR12.00</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Data Package 6, Code 18</td><td>1000MB, 30 days, EUR18.00</td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td>Data Package 7, Code 19</td><td>2000MB, 30 days, EUR34.00</td>
                                    </tr> -->
                                    <tr>
                                        <td>Data Package 6, Code 11</td><td>1000MB, 30 days, EUR18.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7, Code 40</td><td>2000MB, 30 days, EUR34.00</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Zone 2**</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 1, Code 21</td><td>10MB, 1 days, EUR1.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2, Code 22</td><td>50MB, 1 day, EUR3.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3, Code 23</td><td>150MB, 7 days, EUR9.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4, Code 24</td><td>250MB, 14 days, EUR14.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5, Code 25</td><td>500MB, 30 days, EUR26.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 6, Code 26</td><td>1000MB, 30 days, EUR49.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7, Code 27</td><td>2000MB, 30 days, EUR89.00</td>
                                    </tr> --}}
                                    <tr>
                                        <td>Zone B***</td>
                                    </tr>
                                    <!-- Before it code was 29-35 -->
                                    <tr>
                                        <td>Data Package 1, Code 1</td><td>10MB, 1 day, EUR1.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2, Code 2</td><td>50MB, 1 day, EUR5.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3, Code 3</td><td>150MB, 7 days, EUR10.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4, Code 4</td><td>250MB, 14 days, EUR19.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5, Code 5</td><td>500MB, 30 days, EUR35.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 6, Code 9</td><td>1000MB, 30 days, EUR55.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7, Code 8</td><td>2000MB, 30 days, EUR89.00</td>
                                    </tr>*/ ?>
                                    <tr>
                                        <td> Available in following countries: </td>
                                            </tr>
                                            <tr>
                                               <td>*Zone A : Armenia, Australia, Austria, Azerbijan, Belgium, Bulgaria, Chile, China, Colombia, Costa Rica, Croatia, Cyprus, Czech.Rep., Denmark, Estonia, Faeroe Islands, Finland, France, Georgia, Germany, Gibraltar, Greece, Greenland, Guadeloupe, Guatemala, Honduras, HongKong, Hungary, Iceland, Ireland, Israel, Italy, Kazakhstan, Korea (South), Latvia, Liechtenstein, Lithuania, Luxembourg, Malaysia, Malta, Mexico, Montenegro, Netherlands, Nicaragua, Norway, Palestine, Paraguay, Peru, Poland, Portugal, Puerto Rico, Romania, Russia, San Marino, Singapore, Slovakia, Slovenia, Spain, Sweden, Switzerland, Thailand, Turkey, United Kingdom, USA, Uruguay, Vatican City. </td>
                                            </tr>
                                            {{-- <tr>
                                               <td>**Zone 2 : Countries zone 1 + Argentina, Belarus, Canada, El Salvador, Indonesia, Panama, Philippines, Saudi Arabia, South Africa, Tajikistan. </td>
                                            </tr> --}}
                                            <tr>
                                               <td>***Zone B : Countries zone A + Anguilla, Antigua-and-Barbuda, Aruba, Barbados, Bermuda, Brazil, British Virgin Islands, Cayman Islands, Dominica, Ecuador, Egypt, Grenada, Haiti, India, Jamaica, Japan, Kuwait, Macau, Macedonia, Moldova, Nepal, Netherlands Antilles, New Zealand, Nigeria, Qatar,  Serbia, Sri Lanka, St.Kitts, St Lucia, St.Vincent / Grenada, Suriname, Taiwan, Turk &amp; Caicos Isl., Ukraine, United Arab Emirate, Vietnam. </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-sm-6 right-block">
                    <div class="item">
                        <h2>Common Problems</h2>
                        <div class="panel-group" id="accordion-cp">
                            <div class="panel panel-default active">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse24">I can‘t register on the website.</a>
                                    </h4>
                                </div>
                                <div id="collapse24" class="panel-collapse collapse in">
                                    <div class="panel-body">To register, visit the registration page. Complete all fields marked with an asterisk and do not forget to accept the terms and conditions of sale.
                                    If this information is not helpful, please contact our technical support at <a href="mailto:support@xxsim.com">support@xxsim.com</a>.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse25">I have not received the validation email of my record.</a>
                                    </h4>
                                </div>
                                <div id="collapse25" class="panel-collapse collapse">
                                    <div class="panel-body">If you have not received the email validation of your account, please check your junk mail. If you still can’t find our email, please contact our technical support at <a href="mailto:support@xxsim.com">support@xxsim.com</a>.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse26">I can’t connect to my account (error message).</a>
                                    </h4>
                                </div>
                                <div id="collapse26" class="panel-collapse collapse">
                                    <div class="panel-body">If you are unable to login to your account, make sure you fully complete your registration (you must click a link in the email you received after your registration).</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse27">If you are unable to login to your account, make sure you fully complete your registration (you must click a link in the email you received after your registration).</a>
                                    </h4>
                                </div>
                                <div id="collapse27" class="panel-collapse collapse">
                                    <div class="panel-body">To activate your XXSIM, your phone must be connected to an active network to receive the code by SMS.
                                    Please check that your phone is not locked (SIMlock) by an operator.
                                    It must be in the automatic mode, and not manually set to the network.
                                    If you cannot see the signal bars, please try to insert your XXSIM in another mobile phone. This can happen with some software versions of iPhones. If these steps don’t help, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a></div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse28">An "Insert XXSIM" message arrives after installation of the XXSIM card</a>
                                    </h4>
                                </div>
                                <div id="collapse28" class="panel-collapse collapse">
                                    <div class="panel-body">Remove the card, clean the contacts of the card and the handset, then insert the card back into the handset.
                                    To check the card, insert it into some another handset.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse29">It is impossible to make an outgoing call (incoming calls can be received)</a>
                                    </h4>
                                </div>
                                <div id="collapse29" class="panel-collapse collapse">
                                    <div class="panel-body">Please check your balance by typing *146*099#. Make a call using correct dialing format and dial an existing phone#.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse30">It’s impossible to make and receive calls</a>
                                    </h4>
                                </div>
                                <div id="collapse30" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ol class="list-unstyled faq-inner-list">
                                            <li><p>Check if your XXSIM is logged to a network (signal bar).</p></li>
                                            <li><p>Check if you have registered and activated your XXSIM.</p></li>
                                            <li><p>Please check your balance by typing *146*099#.</p></li>
                                            <li><p>If it still doesn’t work, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a> and explain the problem in detail.</p></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse31">When making a call, a voice message in English comes: "The dialed number can’t be reached with this GSM card"</a>
                                    </h4>
                                </div>
                                <div id="collapse31" class="panel-collapse collapse">
                                    <div class="panel-body">Call from the XXSIM menu.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse32">When making a call, a message comes on the display: "The call is changed", "Call restricted", "Calls not allowed" and nothing more happens</a>
                                    </h4>
                                </div>
                                <div id="collapse32" class="panel-collapse collapse">
                                    <div class="panel-body">Call from the XXSIM menu.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse33">When trying to call from the XXSIM menu, a message appears on the display: The handset doesn't support SERVICE command from XXSIM or XXSIM menu is absent in the phone</a>
                                    </h4>
                                </div>
                                <div id="collapse33" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-unstyled faq-inner-list">
                                            <li><p>Don’t call using the XXSIM menu, instead use a special dialing scheme: *146*number with international prefix# and press the "call" button.</p></li>
                                            <li><p>Try to use another operator network</p></li>
                                            <li><p>Try to turn the compatibility mode: </p>
                                                <ol>
                                                    <li><p>Open the "XXSIM menu".</p></li>
                                                    <li><p>Select "Settings".</p></li>
                                                    <li><p>Agree with the message by pressing "Yes" or "OK".</p></li>
                                                    <li><p>Dial digits "1101" and select "Yes" or "OK".</p></li>
                                                    <li><p>"CC Option X: ON" will display and then select "Yes" or "OK".</p></li>
                                                    <li><p>Switch the phone off and then back on.</p></li>
                                                    <li><p>Try to place a call.</p></li>
                                                </ol>
                                            </li>
                                        </ul>
                                    <p>To turn off the compatibility mode (if you are switching to a handset that doesn't require it) follow the same instructions, but enter the digits 1102 in step 4.</p></div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse34">I can’t use the internet or synchronize my emails on my mobile phone</a>
                                    </h4>
                                </div>
                                <div id="collapse34" class="panel-collapse collapse">
                                    <div class="panel-body">To use the internet or synchronize your emails please enable roaming in the options of your mobile phone.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse35">It is impossible to send SMS messages</a>
                                    </h4>
                                </div>
                                <div id="collapse35" class="panel-collapse collapse">
                                    <div class="panel-body">Please check your balance by typing *146*099#. Dial the correct phone#, e.g. +37212345678. Clear the memory.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse36">I can’t reload my XXSIM:</a>
                                    </h4>
                                </div>
                                <div id="collapse36" class="panel-collapse collapse">
                                    <div class="panel-body">If you experience problems with your payment by credit card, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a> and detail the problem</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse37">How activate my XXSIM when I use an IPad?</a>
                                    </h4>
                                </div>
                                <div id="collapse37" class="panel-collapse collapse">
                                    <div class="panel-body">If you buy a XXSIM for your IPad, you should use a mobile phone to activate your card.</div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-cp" data-target="#collapse38">I can not deactivate the assigned national landline number on my XXSIM card</a>
                                    </h4>
                                </div>
                                <div id="collapse38" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-unstyled faq-inner-list">
                                            <li><p>Please login to your account.</p></li>
                                            <li><p>Click on the "national No".</p></li>
                                            <li><p>Click on the red "x" on the left side of the XXSIM number.
                                            The national number will be available again in the list of national numbers.</p></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
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