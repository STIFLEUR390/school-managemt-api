@component('mail::message')
# Reset Password

Reset or change your password.

@component('mail::button', ['url' => env('APP_FRONT_URL_FOR_RESET_PASSWORD') .'change-password?token='.$token])
Change Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
