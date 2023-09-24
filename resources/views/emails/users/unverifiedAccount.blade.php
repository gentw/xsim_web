@component('mail::message')
Dear {{ $request['name'] }},  

You have not yet activated your account on xxsim.com 

Your username: {{ $request['username'] }}

To activate your account please click on the below button:
@component('mail::button', ['url' => url('register/verify', $request['activation_code'])])
Activate your account
@endcomponent

If you have received this message in error simply do not click on the button above.  

Best wishes,

XXSIM Team 

---

If you have any questions, please send requests to support@xxsim.com  

Please note: This e-mail message was sent from a notification-only address that cannot accept incoming e-mail. 

Please do not reply to this message.
@endcomponent
