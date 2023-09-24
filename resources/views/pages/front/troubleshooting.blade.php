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
            <ul class="list-unstyled">
                <li>
                    <h4>I can‘t register on the website.</h4>
                    <p>To register, visit the registration page. Complete all fields marked with an asterisk and do not forget to accept the terms and conditions of sale.
                    If this information is not helpful, please contact our technical support at <a href="mailto:support@xxsim.com">support@xxsim.com</a>.</p>
                </li>
                <li>
                    <h4>I have not received the validation email of my record.</h4>
                    <p>If you have not received the email validation of your account, please check your junk mail. If you still can’t find our email, please contact our technical support at <a href="mailto:support@xxsim.com">support@xxsim.com</a>.</p>
                </li>
                <li>
                    <h4>I can’t connect to my account (error message).</h4>
                    <p>If you are unable to login to your account, make sure you fully complete your registration (you must click a link in the email you received after your registration).</p>
                </li>
                <li>
                    <h4>If you are unable to login to your account, make sure you fully complete your registration (you must click a link in the email you received after your registration).</h4>
                    <p>To activate your XXSIM, your phone must be connected to an active network to receive the code by SMS.
                    Please check that your phone is not locked (SIMlock) by an operator.
                    It must be in the automatic mode, and not manually set to the network.
                    If you cannot see the signal bars, please try to insert your XXSIM in another mobile phone. This can happen with some software versions of iPhones. If these steps don’t help, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a></p>
                </li>
                <li>
                    <h4>An</h4>
                    <p>Remove the card, clean the contacts of the card and the handset, then insert the card back into the handset.
                    To check the card, insert it into some another handset.</p>
                </li>
                <li>
                    <h4>It is impossible to make an outgoing call (incoming calls can be received)</h4>
                    <p>Please check your balance by typing *146*099#. Make a call using correct dialing format and dial an existing phone#.</p>
                </li>
                <li>
                    <h4>It’s impossible to make and receive calls</h4>
                    <ol>
                        <li><p>Check if your XXSIM is logged to a network (signal bar).</p></li>
                        <li><p>Check if you have registered and activated your XXSIM.</p></li>
                        <li><p>Please check your balance by typing *146*099#.</p></li>
                        <li><p>If it still doesn’t work, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a> and explain the problem in detail.</p></li>
                    </ol>
                </li>
                <li>
                    <h4>When making a call, a voice message in English comes: "The dialed number can’t be reached with this GSM card"</h4>
                    <p>Call from the XXSIM menu.</p>
                </li>
                <li>
                    <h4>When making a call, a message comes on the display: "The call is changed", "Call restricted", "Calls not allowed" and nothing more happens</h4>
                    <p>Call from the XXSIM menu.</p>
                </li>
                <li>
                    <h4>When trying to call from the XXSIM menu, a message appears on the display: The handset doesn't support SERVICE command from XXSIM or XXSIM menu is absent in the phone</h4>
                    <ul class="list-unstyled faq-list-inner">
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
                    <p>To turn off the compatibility mode (if you are switching to a handset that doesn't require it) follow the same instructions, but enter the digits 1102 in step 4.</p>
                </li>
                 <li>
                    <h4>I can’t use the internet or synchronize my emails on my mobile phone</h4>
                    <p>To use the internet or synchronize your emails please enable roaming in the options of your mobile phone.</p>
                </li>
                 <li>
                    <h4>It is impossible to send SMS messages</h4>
                    <p>Please check your balance by typing *146*099#. Dial the correct phone#, e.g. +37212345678. Clear the memory.</p>
                </li>
                 <li>
                    <h4>I can’t reload my XXSIM:</h4>
                    <p>If you experience problems with your payment by credit card, please contact us by email at <a href="mailto:support@xxsim.com">support@xxsim.com</a> and detail the problem</p>
                </li>
                <li>
                    <h4>How activate my XXSIM when I use an IPad?</h4>
                    <p>If you buy a XXSIM for your IPad, you should use a mobile phone to activate your card.</p>
                </li>
                <li>
                    <h4>I can not deactivate the assigned national landline number on my XXSIM card</h4>
                    <ul class="list-unstyled faq-inner-list">
                        <li><p>Please login to your account.</p></li>
                        <li><p>Click on the „national No“.</p></li>
                        <li><p>Click on the red „x“ on the left side of the XXSIM number.
                        The national number will be available again in the list of national numbers.</p></li>
                    </ul>
                </li>
            </ul>   
        </article>
    </section>
</main>
@endsection

