<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    //
    public function permission($id){
        $permissions =Permission::where('guard_name', 'user')->get();
        $user = User::with('permissions')->find($id);
        if($user->permissions->count() >0){
            foreach($permissions as $permission){
                $permission->setAttribute('active', false);
                if($user->hasPermissionTo($permission)){
                    $permission->setAttribute('active', true);
                }
            }
        }
        return response()->view('cms.users.permissions',[
            'permissions' => $permissions,
            'user' => $user
        ]);
    }

    public function store(Request $request){
//        dd($request->all());
        $validator = Validator($request->all(), [
            'ids' => 'array'
        ]);
        if(!$validator->fails()){
            $user = User::find($request->id);
            $user->syncPermissions($request->get('ids'));

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
