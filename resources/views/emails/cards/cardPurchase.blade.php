@component('mail::message')
Dear {{ $request['name'] }},  

Thank you for your purchase from our website {{ env('APP_URL') }}. We're pleased with your choice of XXSIM as your wireless roaming service provider. 

Your Reference Web Order Number is: {{ $request['order_id'] }}

Your order has been processed. 

If you ordered a new SIM card, we estimate your order will be shipped within 2 - 5 business days. 

Please when you get the XXSIM card click on the following button for the activation.
@component('mail::button', ['url' => url('dashboard/add-card')])
Add your card
@endcomponent

Best wishes, 

XXSIM Team 

---

If you have any questions, please send requests to support@xxsim.com  

Please note: This e-mail message was sent from a notification-only address that cannot accept incoming e-mail. 

Please do not reply to this message.
@endcomponent
