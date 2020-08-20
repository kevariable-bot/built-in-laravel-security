@component('mail::message')
# Welcome {{ $notifiable->name }}

Before you start journey please verify your account.

@component('mail::button', ['url' => $url])
Verify Email Address.
@endcomponent

If you did not create an account, no further action is required.
Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {{ $url }} 
@endcomponent

@endcomponent
