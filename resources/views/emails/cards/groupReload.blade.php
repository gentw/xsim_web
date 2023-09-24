@component('mail::message')
Dear {{ $request['name'] }},  

Your XXSIM group {{ $request['group_name'] }} has been reloaded with €{{ $request['amount'] }}.

You can now once again enjoy the best rates on international roaming and data packages.

Best wishes, 

XXSIM Team 
@endcomponent

