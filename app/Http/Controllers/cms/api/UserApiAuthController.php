<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Mail\ForgetPassword;
use App\Mail\ReservationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserApiAuthController extends Controller
{
    //

    public function login(Request $request){
        $validator = Validator($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();
            if(!Hash::check($request->get('password'), $user->password)){
                return response()->json(['status' => false, 'message' => 'خطأ في كلمة المروور'], 200);
               
            }
            $this->revokeActiveTokens($user->id);
            $response = Http::asForm()
                ->post('http://hospital.pah.ps/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '1',
                    'client_secret' => 'NOxHIVVKoViMUA922EgYuKjtfjkOK2cn4Y9LYpBA',
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'scope' => '*',
                ]);
                //return response()->json($response);
            $user->setAttribute('token', $response->json()['access_token']);
            $user->setAttribute('refresh_token', $response->json()['refresh_token']);
            return response()->json(['status' => true, 'message'=>'تم تسجيل الدخول بنجاح', 'user' => $user], 200);
        }else{
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
        }
    }

    public function register(Request $request){
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required|in:M,F',
//            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'full_name' => $request->get('full_name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'phone' => $request->get('phone'),
//                'city_id' => $request->get('city_id'),
                'address' => $request->get('address'),
                'password' => $request->has('password') ? Hash::make($request->password) : Hash::make('password')
            ];
            $isSaved = $user = User::updateOrCreate(['id' => 0], $data);
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/users/', 'public', 'user_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $user->image()->save($image);
            }else{
                $image = new Image();
                $image->path = 'images/avatar.png';
                $isSaved = $user->image()->save($image);
            }
            //$this->login($request);
//            $user->assignRole('user');
            return response()->json(['status' => true,'message' => $isSaved ? 'تم إنشاء المستخدم' : 'خطأ في إنشاء المستخدم']);
        }else
            return response()->json(['status' => false,'message' => $validator->getMessageBag()->first()], 200);
    }
    public function forgetPassword(Request $request){
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if (!$validator->fails()){
//            dd($request->all());
            $user = User::where('email', '=', $request->email)->first();
            $user->password_token  = Str::random(50);
            $user->save();
//            dd($user->email);
            Mail::to($user->email)->send(new ForgetPassword($user));
            return response()->json(['status' => true, 'message' => 'تم إرسل كلمة السر تحقق من الإيميل'], 200);
        }else
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
    }
    
    
    public function changePassword(Request $request){
        $validator=Validator($request->all(), [
            'current_password'=>'required|string|min:3|password',
            'new_password'=>'required|string|min:3|password|confirmed',
            'new_password_confirmation'=>'required|string|min:3|password'
        ]);

        if(!$validator->fails()){
            $user = Auth::guard('userApi')->user();
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            return response()->json(['message' => 'تم تغيير كلمة المرور']);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 200);
        }

    }
    
    private function revokeActiveTokens($userId)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->where('revoked', false)
            ->update([
                'revoked' => true,
            ]);
    }
    private function checkAccessTokens($userId)
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->where('revoked', false)
            ->exists();
    }

    public function logout(Request $request){
        $token = $request->user('userApi')->token();
        $isRevoked = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update([
                'revoked'=>true
            ]);
        if($isRevoked){
            $isRevoked = $token->revoke();
            return response()->json(['status' => $isRevoked ? true : false, 'message' => $isRevoked ?  'تم تسجيل الخروج بنجاح' : 'خطأ تأكد تسجيل الخروج'], 200);
        }else{
            return response()->json(['status' => false, 'message' => 'خطأ'], 400);
        }
    }

    public function refreshToken(Request $request){

        $validator = Validator($request->all(), [
            'email' => 'required|numeric|exists:users,email',
            'refresh_token' => 'exits:oauth_refresh_tokens,id'
        ]);

        if (!$validator->fails()) {
            $user = User::where('id', $request->get('id'))->first();
            $response = Http::asForm()->post('http://passport-app.com/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->get('refresh_token'),
                'client_id' => '2',
                'client_secret' => 'qaniYfUOsaVwoydMAhBhVJ92FlGT8XC5UsGQBEA7',
                'scope' => '*',
            ]);
            $user->setAttribute('token', $response->json()['access_token']);
            $user->setAttribute('refresh_token', $response->json()['refresh_token']);
            return response()->json(['status' => true, 'message'=>'تم تحديث الدخول بنجاح', 'user' => $user], 200);
        }else{
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }
}


