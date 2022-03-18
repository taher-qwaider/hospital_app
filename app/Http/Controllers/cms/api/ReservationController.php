<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Mail\ReservationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;


class ReservationController extends Controller
{
    //

    public function sendReservationEmail(Request $request){
        $user = [];

            $reservation_email = Setting::where('key', 'reservation_email')->first();
            $doctor_name = $request->doctor_name;
            $date = $request->date;
            $user['name'] = $request->patient_name;
            $user['phone'] = $request->phone;

            Mail::to($reservation_email->value)->send(new ReservationEmail($user, $doctor_name, $date));
            return response()->json(['status' => true, 'message' => 'تم إرسال الإيميل بنجاح'], 200);

    }
}
