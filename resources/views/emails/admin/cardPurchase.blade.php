@component('mail::message')
Dear Admin,  

You have new card order. Oder details are as below.

@component('mail::table')
|        					|			
| ------------- 			|-------------
| Date     					| {{ date('Y-m-d') }} 	
| User name      			| {{ $request['name'] }}
| Regualr Sim Quantities   	| {{ $request['qty_regular'] }}
| 25% off Sim Quantities    | {{ $request['qty_32'] }}
| Free Sim Quantities		| {{ $request['qty_50'] }}
| Address					| {{ $request['address'] }}
| City						| {{ $request['city'] }}
| Country					| {{ $request['country'] }}
| Postal Code				| {{ $request['zip'] }}
| Order Number				| {{ $request['order_number'] }}
| Transaction Id 			| {{ $request['transation_id'] }}
| Paid Amount 				| {{ $request['amount'] }}
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
