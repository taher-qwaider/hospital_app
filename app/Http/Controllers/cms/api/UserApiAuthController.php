<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserApiAuthController extends Controller
{
    //

    public function login(Request $request){
        $validator = Validator($request->all(), [
            'id' => 'required|numeric|exists:users,id',
            'password' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $user = User::where('id', $request->get('id'))->first();
            $this->revokeActiveTokens($user->id);
            $response = Http::asForm()
                ->post('http://127.0.0.1:8081/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'wrdz9dk7RvcdN21zZgZp78vDiW0tooSlWvSVPo77',
                    'username' => $request->get('id'),
                    'password' => $request->get('password'),
                    'scope' => '*',
                ]);
            $user->setAttribute('token', $response->json()['access_token']);
            $user->setAttribute('refresh_token', $response->json()['refresh_token']);
//            return response()->json(['status' => $response->json()], 200);
            return response()->json(['status' => true, 'message'=>'تم تسجيل الدخول بنجاح', 'user' => $user], 200);
        }else{
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
        }
    }

    public function register(Request $request){
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:9|unique:users,phone',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required|in:M,F',
//            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'teacher_id' => $request->get('teacher_id'),
                'phone' => $request->get('phone'),
//                'city_id' => $request->get('city_id'),
                'address' => $request->get('address'),
                'password' => Hash::make('password')
            ];
            $isSaved = $user = User::updateOrCreate(['id' => 0], $data);

            $user->assignRole('user');
            return response()->json(['message' => $isSaved ? 'تم إنشاء المستخدم' : 'خطأ في إنشاء المستخدم', 'id' => $user->id]);
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 200);
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
            'id' => 'required|numeric|exists:users,id',
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


