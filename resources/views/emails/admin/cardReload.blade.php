@component('mail::message')
Dear Admin,  

User reloads a card. Details are as below.

@component('mail::table')
|        					|			
| ------------- 			|-------------
| Date     					| {{ date('Y-m-d') }} 	
| User name      			| {{ $request['name'] }}
| Card Number      			| {{ $request['card'] }}
| Validity      			| {{ date('Y-m-d', strtotime("+1 year")) }}
| Transaction Id 			| {{ $request['transation_id'] }}
| Paid Amount 				| {{ $request['amount'] }}
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
