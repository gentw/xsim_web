@component('mail::message')
Dear {{ $request['name'] }},  

We are waiting for you to complete your checkout to obtain an XXSIM SIM card.

In order to complete your order and start enjoying the best rates on international calls and mobile data, please click on below button.
@component('mail::button', ['url' => url('online-shop')])
Buy XXSIM cards
@endcomponent

Best wishes, 

XXSIM Team 

---

If you have any questions, please send requests to support@xxsim.com  

Please note: This e-mail message was sent from a notification-only address that cannot accept incoming e-mail. 

Please do not reply to this message.
@endcomponent
