@component('mail::message')
Dear Admin,  

User reloads a group. Details are as below.

@component('mail::table')
|        					|			
| ------------- 			|-------------
| Date     					| {{ date('Y-m-d') }} 	
| User name      			| {{ $request['name'] }}
| Group Id      			| {{ $request['group_id'] }}
| Group Name      			| {{ $request['group_name'] }}
| Transaction Id 			| {{ $request['transation_id'] }}
| Paid Amount 				| {{ $request['amount'] }}
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
