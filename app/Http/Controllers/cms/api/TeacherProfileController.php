<?php

namespace App\Http\Controllers\cms\api;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherProfileController extends Controller
{
    use FileUpload;
    //
    public function get(Request $request){
        if ($request->expectsJson()){
            $teacher = Auth::guard('teacherApi')->user()->with('users')->first();
            return response()->json(['status' => true, 'data' => $teacher]);
        }
    }

    public function edit(Request $request){
        if ($request->expectsJson()){
            $teacher = Auth::guard('teacherApi')->user();
            $validator = Validator($request->all(), [
                'first_name' =>'required|string|min:3',
                'last_name' =>'required|string|min:3',
                'email' =>'required|email|unique:teachers,email,'.$teacher->id,
                'phone' =>'required|digits:9|unique:teachers,phone,'.$teacher->id,
                'level' =>'required|string|in:A,B,C',
                'gender' =>'required|string|in:M,F',
                'address' =>'required|string|min:5',
            ]);
            if (!$validator->fails()){
                $this->saveData($request, $teacher);
                if ($request->hasFile('image')){
                    $this->uploadFile($request->file('image'), 'images/teachers/', 'public', 'teach_' . time());
                    $image = $teacher->image ?? new Image();
                    $image->path = $this->filePath;
                    $isSaved = $teacher->image()->save($image);
                }
                $isSaved = $teacher->save();
                return response()->json(['status' => $isSaved ,'message' => $isSaved ? 'تم تعديل الملف الشخصي' : 'خطأ في تعديل الملف الشخصي', 'user' =>$teacher], $isSaved ? 200 : 400);
            }else
                return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
        }
    }

    public function chats(Request $request){
        if ($request->expectsJson()){
            $adminId = Auth::guard('teacherApi')->user()->admin->id;
            return response()->json(['status' => true, 'admin_id' => $adminId]);
        }
    }
    public function saveData(Request $request, $teacher)
    {
        $teacher->first_name = $request->get('first_name');
        $teacher->last_name = $request->get('last_name');
        $teacher->email = $request->get('email');
        $teacher->phone = $request->get('phone');
        $teacher->gender = $request->get('gender');
        $teacher->teach_level = $request->get('level');
        $teacher->address = $request->get('address');
        return $teacher;
    }
}
