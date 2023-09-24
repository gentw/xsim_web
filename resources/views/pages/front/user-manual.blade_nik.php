@extends('layouts.app')

@section('banner')
<section class="banner support text-center">
    <div class="container">
        <div class="desc">
            <h1>Ask us anything, any time</h1>
        </div>
    </div>
</section>
@endsection

@section('content')
<main>
    <section class="faq-inner">
        <article class="container">
            <h2>DIRECTIONS FOR USE</h2>
            <ul class="list-unstyled">
                <li>
                    <h4>How to make a call with my XXSIM?</h4>
                    <p>The procedure to make calls from your XXSIM is very simple and the same in the whole world. XXSIM works with a callback function that is used when making calls. </p>
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
                       <p> Note: For Samsung, BlackBerry and iPhone users, or r other users that encounter problems while making direct calls: You have to deactivate the call function CC Option X. Open the section XXSIM in you phone menu > Select Settings > Validate > Dial 1101 > Validate > Validate. To deactivate this function do the same as above: Only replace 1101 with 1102.
                    </p>
                </li>
                <li>
                    <h4>How do I send or receive SMS?</h4>
                    <p>Your XXSIM card receives and sends text messages like any other SIM card. No configuration is neccessary because the number of the messaging center +372509900 will be sent to your phone by the network providers.</p>
                </li>
                <li>
                    <h4>How can I control my credit balance?</h4>
                    <p>In order to check your credit balance dial *146*099# and press call.</p>
                </li>
                <li>
                    <h4>How do I call an XXSIM user for free? Yes, you can!</h4>
                    <p>From the below countries, it's possible to call any XXSIM for free, using a toll free phone#. No matter where the XXSIM is located. When receiving a toll free call, EUR0.15/minute will be charged from the XXSIM balance.
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

                   <p>Activate/Deactivate<br/>
                    To activate this feature for your XXSIM, dial *146*711#
                    To deactivate, dial *146*710#
                    To check the status, dial *146*712#</p>

                   <p>How to use<br/>
                    When the feature is activated, Skype users can call your XXSIM number for free using special dialing format +372800XXXXXXXX, where XXXXXXXX is a XXSIM number without the prefix 372.</p>

                   <p>Cost<br/>
                    The call is free for the Skype caller. The cost of the incoming call for the XXSIM user is the incoming call rate in the host country plus EUR0.15/min. In case the XXSIM user is in a country with free incoming calls, the cost will be just EUR0.15 per minute.
                    Example
                    E.g. to call XXSIM# +37254601111 for free from Skype, you should dial +37280054601111. For the Skype user the call is free. If the XXSIM user is in Russia (free incoming calls) and accepts the Skype call, he pays just EUR0.15/min.</p>

                   <p>XXSIM and Viber have forged a unique partnership in order to provide free calls from Viber to all XXSIM numbers!</p>

                   <p>How<br/>
                    When the feature is activated, Viber users can call XXSIM numbers for free using special dialing format +372800XXXXXXXX, where XXXXXXXX is a XXSIM number. Contact XXSIM Support to activate this feature for your XXSIM!</p>

                    <p>Cost<br/>
                    The call is free for Viber user. The cost of incoming Viber call for XXSIM user is incoming call rate in the host country plus 0.15EUR per minute. In case XXSIM user is in the country with free incoming calls, the cost will be just 0.15EUR per minute!</p>
                </li>
                <li>
                    <h4>How call I call an other XXSIM for free?</h4>
                    <p>After dialing the national prefix you can call any XXSIM for free if you use the toll free number. It does not matter in which country the other XXSIM is. When making a free call with the toll free number, EUR0.15/min will be charged to the other XXSIM. Eg. Someone in the US wants to call another XXSIM in the United Arab Emirates. If he/she uses the toll free number, the call will be charged to the call recipient who will have tp pay EUR0.15/min. The caller in the US will not be charged for the call.</p>
                </li>
                <li>
                    <h4>How do I reload my XXSIM?</h4>
                    <p>Log in at http://www.xxsim.com and use the Reload function.</p>
                </li>
                <li>
                    <h4>What is the SIM-card Position Function in My Account?</h4>
                    <p>The SIM-card Position Function in My Account lets you locate your XXSIM on Google Maps up to 100 times in a month (It is possible to activate the feature several times during the same month). This feature costs EUR1/Month.</p>
                </li>
                <li>
                    <h4>What is Internet access configuration (GPRS)?</h4>
                    <p>To use internet with your XXSIM, you have to configurate the access point in your phone:
                    APN: send.ee
                    Username: Your XXSIM phone# without 00, i. eg. 37212345678
                    Password: empty
                    Easy internet configuration: http://www.msettings.net/</p>
                </li>
                <li>
                    <h4>What is the XXSIM menu for?</h4>
                    <p>Your phone menu is now extended by an XXSIM section.
                    Address book: allows you to call phone # in your phone's memory (in case of phone incompatibility with direct call).
                    Call: Place a call (in case of phone incompatibility with direct call).
                    Send SMS: Allows sending discount SMS for EUR0.08 in Europe.
                    Voicemail: To call the voice mailbox (when activated).
                    Check balance: To check the XXSIM credit balance.
                    Add credit : Inactive feature
                    Customer care: To call the customer care.
                    Extras : Inactive feature
                    Settings : Special features (only on technical staff's request)</p>
                </li>
                <li>
                    <h4>List of USSD commands:</h4>
                    <p>
                        <div class="table-responsive">
                            <table style="width: 100%; border: 0;">
                                <tbody>
                                    <tr>
                                        <td width="40%">*146*number with international prefix#</td><td width="60%">Call, i. eg.: *146*003312345678#</td>
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
                                        <td>*146*942*Package code#</td><td>Check status Data Zone</td>
                                    </tr>
                                    <tr>
                                        <td>Zone 1*</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 1</td><td>10MB, 1 day, EUR0.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2</td><td>50MB, 1 day, EUR2.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3</td><td>150MB, 7 days, EUR5.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4</td><td>250MB, 14 days, EUR8.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5</td><td>500MB, 30 days, EUR12.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 6</td><td>1000MB, 30 days, EUR18.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7</td><td>2000MB, 30 days, EUR34.00</td>
                                    </tr>
                                    <tr>
                                        <td>Zone 2**</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 1</td><td>10MB, 1 days, EUR1.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2</td><td>50MB, 1 day, EUR3.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3</td><td>150MB, 7 days, EUR9.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4</td><td>250MB, 14 days, EUR14.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5</td><td>500MB, 30 days, EUR26.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 6</td><td>1000MB, 30 days, EUR49.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7</td><td>2000MB, 30 days, EUR89.00</td>
                                    </tr>
                                    <tr>
                                        <td>Zone 3***</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 1</td><td>10MB, 1 day, EUR1.40</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 2</td><td>50MB, 1 day, EUR5.50</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 3</td><td>150MB, 7 days, EUR15.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 4</td><td>250MB, 14 days, EUR24.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 5</td><td>500MB, 30 days, EUR45.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 6</td><td>1000MB, 30 days, EUR89.00</td>
                                    </tr>
                                    <tr>
                                        <td>Data Package 7</td><td>2000MB, 30 days, EUR169.00</td>
                                    </tr>
                                    <tr>
                                        <td> Available in following countries: </td></tr><tr><td>*Zone 1 : Armenia, Australia, Austria, Azerbijan, Belgium, Bulgaria, Chile, China, Colombia, Costa Rica, Croatia, Cyprus, Czech.Rep., Denmark, Estonia, Faeroe Islands, Finland, France, Georgia, Germany, Gibraltar, Greece, Greenland, Guadeloupe, Guatemala, Honduras, HongKong, Hungary, Iceland, Ireland, Israel, Italy, Kazakhstan, Korea (South), Latvia, Liechtenstein, Lithuania, Luxembourg, Malaysia, Malta, Mexico, Montenegro, Netherlands, Nicaragua, Norway, Palestine, Paraguay, Peru, Poland, Portugal, Puerto Rico, Romania, Russia, San Marino, Singapore, Slovakia, Slovenia, Spain, Sweden, Switzerland, Thailand, Turkey, United Kingdom, USA, Uruguay, Vatican City. </td></tr><tr><td>**Zone 2 : Countries zone 1 + Argentina, Belarus, Canada, El Salvador, Indonesia, Panama, Philippines, Saudi Arabia, South Africa, Tajikistan. </td></tr><tr><td>***Zone 3 : Countries zone 1 + 2 + Anguilla, Antigua-and-Barbuda, Aruba, Barbados, Bermuda, Brazil, British Virgin Islands, Cayman Islands, Dominica, Ecuador, Egypt, Grenada, Haiti, India, Jamaica, Japan, Kuwait, Macau, Macedonia, Moldova, Nepal, Netherlands Antilles, New Zealand, Nigeria, Qatar,  Serbia, Sri Lanka, St.Kitts, St Lucia, St.Vincent / Grenada, Suriname, Taiwan, Turk &amp; Caicos Isl., Ukraine, United Arab Emirate, Vietnam. </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </p>
                </li>
            </ul>   
        </article>
    </section>
</main>
@endsection

