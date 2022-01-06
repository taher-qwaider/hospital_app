<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\City;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('cms.admins.index');
    }
    public function getAdmins(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Admin::all())
                ->addIndexColumn()
                ->addColumn('permissions', function($row){
                    $permissionBtn = "<a href='/panel/admin/admins/$row->id/permissions' class='edit btn btn-success btn-sm'>$row->permissions_count صلاحيات</a>";
                    return $permissionBtn;
                })
                ->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('roles', function($row){
                    $roleBtn = "<a href='/panel/admin/admins/$row->id/roles' class='edit btn btn-primary btn-sm'>$row->roles_count روول</a>";
                    return $roleBtn;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/admins/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
                    return $actionBtn;
                })
                ->rawColumns(['action', 'permissions', 'roles'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        return  response()->view('cms.admins.create', ['cities' => $cities]);
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:9|unique:users,phone',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $admin = new Admin();
            $admin = $this->saveData($request, $admin);
            $isSaved = $admin->save();
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/admins/', 'public', 'user_' . time() . '.jpg');
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $admin->image()->save($image);
            }
            $admin->assignRole('admin');
            return response()->json(['message' => $isSaved ? 'تم إنشاء المسئوول' : 'خطأ في إنشاء المسئوول', 'id' => $admin->id], $isSaved ? 200 : 400);
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
        $admin = Admin::find($id);
        $cities = City::all();
        return response()->view('cms.admins.edit', [
            'admin'=>$admin,
            'cities' => $cities
        ]);
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits:9|unique:users,phone,'.$id,
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $admin = Admin::find($id);
            $admin = $this->saveData($request, $admin);
            $isSaved = $admin->save();
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($admin->image->path);
                $this->uploadFile($request->file('image'), 'images/admins/', 'public', 'user_' . time() . '.jpg');
                $image = $admin->image;
                $image->path = $this->filePath;
                $admin->image()->save($image);
            }
            return response()->json(['message' => $isSaved ? 'تم تعديل المسؤول' : 'خطأ في تعديل المسؤول'], $isSaved ? 200 : 400);
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
        $isDeleted = Admin::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المسؤول' : 'خطأ ف حذف المسؤول'], $isDeleted ? 200:400);
    }
    public function saveData(Request $request, $admin): Admin
    {
        $admin->first_name = $request->get('first_name');
        $admin->last_name = $request->get('last_name');
        $admin->email = $request->get('email');
        $admin->phone = $request->get('phone');
        $admin->city_id = $request->get('city_id');
        $admin->address = $request->get('address');
        $admin->password = Hash::make('password');
        $admin->save();
        $admin = $admin->refresh();
        return $admin;
    }
}
