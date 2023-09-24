@component('mail::message')

Dear XXSIM user,

We are happy to announce that we have extended our services to {{ $request['country'] }}! You can now enjoy free incoming calls, outgoing calls at EUR {{ $request['out_call'] }}/min, and send SMS messages at EUR {{ $request['out_sms'] }}/SMS.

We are always working on improving our service and adding more countries to our extensive coverage area.

Best wishes,

XXSIM Team 

@endcomponent