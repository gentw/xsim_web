@component('mail::message')

Hello,

Your Contact {{ Auth::user()->name . ' ' . Auth::user()->surname }} has sent an invitaion to register your self at [xxsim]({{env('APP_URL')}} "xxsim").

Please click on below button to register at xxsim.

@component('mail::button', ['url' => url('register')])
Register
@endcomponent

@endcomponent
