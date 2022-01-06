<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    //

    public function permission($id){
        $permissions =Permission::where('guard_name', 'admin')->get();
        $admin = Admin::with('permissions')->find($id);
        if($admin->permissions->count() >0){
            foreach($permissions as $permission){
                $permission->setAttribute('active', false);
                if($admin->hasPermissionTo($permission)){
                    $permission->setAttribute('active', true);
                }
            }
        }
        return response()->view('cms.admins.permissions',[
            'permissions' => $permissions,
            'admin' => $admin
        ]);
    }

    public function store(Request $request, $id){
//        dd($request->all());
        $validator = Validator($request->all(), [
            'ids' => 'array'
        ]);
        if(!$validator->fails()){
            $admin = Admin::find($id);
           // $admin->syncPermissions($request->get('ids'));
            foreach ($request->get('ids') as $id){
                $permission = Permission::find($id);
                $admin->givePermissionTo($permission);
//                if($admin->hasPermissionTo($permission)){
//                    $admin->revokePermissionTo($permission);
//                }else{
//                    $admin->givePermissionTo($permission);
//                }
            }
            return response()->json(['message'=> "تم حفظ الصلاحية بنجاح" ]);

        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }
}
