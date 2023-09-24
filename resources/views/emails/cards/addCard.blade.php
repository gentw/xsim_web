@component('mail::message')
Dear {{ $request['name'] }},  

Your code for activating your XXSIM card is {{ $request['activation_code'] }}.

Please enter this code into the appropriate field on your user dashboard.

Best wishes, 

XXSIM Team 
@endcomponent
