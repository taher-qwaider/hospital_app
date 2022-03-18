@component('mail::message')
# Reservation Email

the user : {{ $user['name']  }} how has phone No : {{ $user['phone'] }} wants to book a reservation for the Doctor : {{ $doctor_name  }} on {{ $date }}
#
قام المستخدم : {{$user['name'] }} صاحب رقم الهاتف {{ $user['phone'] }} بطلب حجز موعد لدى الدكتور {{ $doctor_name }} في التاريخ {{ $date }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
