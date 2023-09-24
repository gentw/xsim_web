@component('mail::message')
Dear {{ $request['name'] }},  

Your XXSIM {{ $request['card'] }} has been reloaded with €{{ $request['amount'] }} and its validity extended until {{ $request['date'] }}. 

You can now once again enjoy the best rates on international roaming and data packages.

Best wishes, 

XXSIM Team 
@endcomponent

