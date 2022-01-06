<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class TeacherPermissionController extends Controller
{
    //
    public function permission($id){
        $permissions =Permission::where('guard_name', 'teacher')->get();
        $teacher = Teacher::with('permissions')->find($id);
        if($teacher->permissions->count() >0){
            foreach($permissions as $permission){
                $permission->setAttribute('active', false);
                if($teacher->hasPermissionTo($permission)){
                    $permission->setAttribute('active', true);
                }
            }
        }
        return response()->view('cms.teachers.permissions',[
            'permissions' => $permissions,
            'teacher' => $teacher
        ]);
    }

    public function store(Request $request){
//        dd($request->all());
        $validator = Validator($request->all(), [
            'ids' => 'array'
        ]);
        if(!$validator->fails()){
            $teacher = Teacher::find($request->id);
            $teacher->syncPermissions($request->get('ids'));

//            foreach ($request->get('ids') as $id){
//                $permission = Permission::find($id);
//                if($user->hasPermissionTo($permission)){
//                    $user->revokePermissionTo($permission);
//                }else{
//                    $user->givePermissionTo($permission);
//                }
//            }
            return response()->json(['message'=> "تم حفظ الصلاحية بنجاح" ]);

        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }
}
