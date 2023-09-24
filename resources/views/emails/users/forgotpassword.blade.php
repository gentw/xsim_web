@component('mail::message')
# Hello!

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $request['url']])
Reset Pasword
@endcomponent

If you did not request a password reset, no further action is required.

Regards,<br>{{ config('app.name') }}

@component('mail::subcopy')
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below
into your web browser: [{{ $request['url'] }}]({{ $request['url'] }})
@endcomponent

@endcomponent
