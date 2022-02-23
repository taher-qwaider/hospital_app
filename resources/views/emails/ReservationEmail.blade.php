@component('mail::message')
# Reservation Email

the user : {{ $user->full_name  }} wants to book a reservation for doctor : {{ $doctor->full_name  }} on {{ $date }}
{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
