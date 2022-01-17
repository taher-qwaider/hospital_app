<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Mail\ReservationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    //

    public function sendReservationEmail($email){
        $validator = Validator(['email'=>$email], [
            'email' => 'email|exists:users,email'
        ]);
        if (!$validator->fails()){
            $user = User::where('email', $email)->first();
            Mail::to($email)->send(new ReservationEmail($user));
            return response()->json(['status' => true, 'message' => 'Reservation Email send Successfully'], 200);

        }else
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
    }
}
