@component('mail::message')
Dear {{ $request['name'] }},

Your XXSIM {{ $request['card'] }} has been reloaded automatically. The balance is {{ $request['balance'] }}.

Best wishes, 

XXSIM Team 
@endcomponent