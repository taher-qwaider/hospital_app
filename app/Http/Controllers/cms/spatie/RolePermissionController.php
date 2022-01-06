<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    //
    public function permission($id){
        $role = Role::find($id);
        $permissions =Permission::where('guard_name', $role->guard_name)->get();
        if($role->permissions->count() >0){
            foreach($permissions as $permission){
                $permission->setAttribute('active', false);
                if($role->hasPermissionTo($permission)){
                    $permission->setAttribute('active', true);
                }
            }
        }
        return response()->view('cms.spatie.roles.permissions',[
            'permissions' => $permissions,
            'role' => $role
        ]);
    }

    public function store(Request $request, $id){
//        dd($request->all());
        $validator = Validator($request->all(), [
            'ids' => 'array'
        ]);
        if(!$validator->fails()){
            $role = Role::find($id);
            foreach ($request->get('ids') as $id){
                $permission = Permission::findOrFail($id);
                if($role->hasPermissionTo($permission)){
                    $role->revokePermissionTo($permission);
                }else{
                    $role->givePermissionTo($permission);
                }
            }
            return response()->json(['message'=> "تم حفظ الصلاحية بنجاح" ]);

        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }
}
