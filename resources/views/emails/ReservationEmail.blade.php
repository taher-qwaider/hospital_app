@component('mail::message')
# Reservation Email

the user : {{ $user->full_name  }} wants to book a reservation for the Doctor : {{ $doctor_name  }} on {{ $date }}
#
قام المستخدم : {{$user->full_name }} بطلب حجز موعد لدى الدكتور  {{ $doctor_name }} في التاريخ {{ $date }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
