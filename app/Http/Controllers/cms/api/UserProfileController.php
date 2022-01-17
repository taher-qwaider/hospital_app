<?php

namespace App\Http\Controllers\cms\api;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    use  FileUpload;
    //
    public function get(Request $request){
        if ($request->expectsJson()){
            $user = Auth::guard('userApi')->user();
            return response()->json(['status' => true, 'data' => $user]);
        }
    }

    public function edit(Request $request){
        if ($request->expectsJson()){
            $user = Auth::guard('userApi')->user();
            $validator = Validator($request->all(), [
                'full_name' =>'required|string|min:3',
                'email' =>'required|email|unique:users,email,'.$user->id,
                'phone' =>'required|digits:9|unique:users,phone,'.$user->id,
                'gender' =>'required|string|in:M,F',
                'address' =>'required|string|min:5',
            ]);
            if (!$validator->fails()){
                $this->userSaveData($request, $user);
                if ($request->hasFile('image')){
                    $this->uploadFile($request->file('image'), 'images/users/', 'public', 'user_' . time());
                    $image = $user->image ?? new Image();
                    $image->path = $this->filePath;
                    $isSaved = $user->image()->save($image);
                }
                $isSaved = $user->save();
                return response()->json(['status' => $isSaved ,'message' => $isSaved ? 'تم تعديل الملف الشخصي' : 'خطأ في تعديل الملف الشخصي', 'data' => $user], $isSaved ? 200 : 400);
            }else
                return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()]);
        }
    }

    public function chats(Request $request){
        if ($request->expectsJson()){
            $adminId = Auth::guard('userApi')->user()->teacher->admin->id;
            return response()->json(['status' => true, 'admin_id' => $adminId], 400);
        }
    }
    public function userSaveData(Request $request, $user): User
    {
        $user->full_name = $request->get('full_name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->gender = $request->get('gender');
        $user->level = $request->get('level');
        $user->address = $request->get('address');
        return $user;
    }
}
