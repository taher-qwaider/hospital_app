<?php

namespace App\Http\Controllers\cms\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ForgetPasswordController extends Controller
{
//    use SendsPasswordResetEmails;

    public function changeForgetPassword(Request $request, $token){
        $user = User::where('password_token', $token)->first();
        if (isset($user))
            return view('cms.resetPassword', ['user' =>$user]);
    }
    
    public function resetForgetPassword(Request $request, $token){
        $validator = Validator($request->all(), [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ]);
        if (!$validator->fails()){
            $user = User::where('password_token', $token)->first();
            $user->password = Hash::make($request->password);
            $user->password_token = '';
            $user->save();
            return response()->json(['status' => false, 'message' => 'password changed Successfuly'], 200);
        }else
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);

    }
}
