<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('cms.spatie.permissions.index');
    }

    public function getPermissions(){
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'guard' => 'required|string|in:admin,teacher,user'
        ]);
        if (!$validator->fails()){
            $permission = new Permission();
            $permission->name =$request->name;
            $permission->guard_name =$request->guard;
            $isSaved = $permission->save();
            return response()->json(['message' => $isSaved ? 'تم إنشاء الصلاحية': 'خطأ في إنشاء الصلاحية'], $isSaved ? 200:400);
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::find($id);
        return response()->view('cms.spatie.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'guard' => 'required|string|in:admin,teacher,user'
        ]);
        if (!$validator->fails()){
            $permission = Permission::find($id);
            $permission->name =$request->name;
            $permission->guard_name =$request->guard;
            $isSaved = $permission->save();
            return response()->json(['message' => $isSaved ? 'تم تعديل الصلاحية': 'خطأ في تعديل الصلاحية'], $isSaved ? 200:400);
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $isDeleted = Permission::destroy($id);
        return response()->json(['message'=> $isDeleted ? 'تم حذف الصلاحية' : 'خطأ في حذف الصلاحية'], $isDeleted ? 200:400);
    }
}
