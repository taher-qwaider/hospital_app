<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Mail\ReservationEmail;
use App\Models\Doctor;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    //

    public function sendReservationEmail(Request $request){
        $user = Auth::guard('userApi')->user();
        $validator = Validator(['email'=>$user->email], [
            'email' => 'email|exists:users,email',
//            'doctor_name'=>  'required|exists:doctors,id'
        ]);
        if (!$validator->fails()){
            $reservation_email = Setting::where('key', 'reservation_email')->first();
            $doctor_name = $request->doctor_name;
            $date = $request->date;
            Mail::to($reservation_email->value)->send(new ReservationEmail($user, $doctor_name, $date));
            return response()->json(['status' => true, 'message' => 'تم إرسال الإيميل بنجاح'], 200);

        }else
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
    }
}
