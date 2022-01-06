<?php

namespace App\Http\Controllers\cms\spatie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('cms.spatie.roles.index');
    }

    public function getRoles(){
        $roles = Role::all();
        return response()->json($roles);
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
            $role = new Role();
            $role->name =$request->name;
            $role->guard_name =$request->guard;
            $isSaved = $role->save();
            return response()->json(['message' => $isSaved ? 'تم إنشاء الدور': 'خطأ في إنشاء الدور'], $isSaved ? 200:400);
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
        $role = Role::find($id);
        return response()->view('cms.spatie.roles.edit', ['role' => $role]);
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
            $role =  Role::find($id);
            $role->name =$request->name;
            $role->guard_name =$request->guard;
            $isSaved = $role->save();
            return response()->json(['message' => $isSaved ? 'تم تعديل الدور': 'خطأ في تعديل الدور'], $isSaved ? 200:400);
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
        $isDeleted = Role::destroy($id);
        return response()->json(['message'=> $isDeleted ? 'تم حذف الدور' : 'خطأ في حذف الدور'], $isDeleted ? 200:400);
    }
}
