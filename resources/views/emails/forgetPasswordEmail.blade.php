@component('mail::message')
# Forget Passord Email

Click the button bellow to change your password

@component('mail::button', ['url' => route('user.password.reset', $user->password_token)])
Rest Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
