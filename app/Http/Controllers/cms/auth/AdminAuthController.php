<?php

namespace App\Http\Controllers\cms\auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    //

    public function view(){
            return response()->view('cms.auth.Adminlogin');
    }
    public function login(Request $request){
//        dd($request->all());
        $validator=Validator($request->all(), [
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|string|min:3',
            'remember_me'=>'boolean'
        ]);
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if(!$validator->fails()){
            if(Auth::guard('admin')->attempt($credentials, $request->get('remember_me'))){
                return response()->json(['message'=>'Login Successfully', 'user' => Auth::guard('admin')->user()], 200);
            }else{
                return response()->json(['message'=>'Failed to Login check Credentials'], 200);
            }
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 200);
        }
    }

    public function profile(){
        $admin = Auth::guard('admin')->user();
        $cities = City::all();
        return view('cms.auth.profile', ['admin' => $admin, 'cities'=> $cities]);
    }

    public function logout(){
        Auth('admin')->logout();
        return redirect()->route('admin.login.view');
    }

    public function changePassword(){
        return view('cms.auth.changePassword');
    }

    public function savePassword(Request $request){
        $validator=Validator($request->all(), [
            'current_password'=>'required|string|min:3|password',
            'new_password'=>'required|string|min:3|password|confirmed',
            'new_password_confirmation'=>'required|string|min:3|password'
        ]);

        if(!$validator->fails()){
            $admin = Auth::guard('admin')->user();
            $admin->password = Hash::make($request->get('new_password'));
            $admin->save();
            return response()->json(['message' => 'تم تغيير كلمة المروور']);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }

    public function forgetPassword(){
        return view('cms.auth.forgetPassword');
    }

    public function sendForgetPasswordEmail(Request $request){
        $validator=Validator($request->all(), [
            'email'=>'required|email|exists:admins,email',
        ]);

        if(!$validator->fails()){
            $admin = Auth::guard('admin')->user();
            $admin->password = Hash::make($request->get('new_password'));
            $admin->save();
            return response()->json(['message' => 'تم تغيير كلمة المروور']);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }
}
