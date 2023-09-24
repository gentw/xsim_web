@component('mail::message')
Dear Admin,  

@if($request['attachment'])
Here is the cards which are expired on {{ date('Y-m-d') }}.
@else
No card expired on {{ date('Y-m-d') }}.
@endif

Best wishes, 

XXSIM Team 
@endcomponent
