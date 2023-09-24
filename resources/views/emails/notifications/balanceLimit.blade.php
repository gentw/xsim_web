@component('mail::message')
Dear {{ $request['name'] }},

Your XXSIM {{ $request['card'] }} reached the minimum alert limit {{ $request['balance'] }}.

Best wishes, 

XXSIM Team 
@endcomponent
