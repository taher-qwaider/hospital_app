<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Image;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
        return response()->view('cms.users.index');
    }

    public function getUsers(Request $request){
        if ($request->ajax()) {
            return DataTables::of(User::all())
                ->addIndexColumn()
                ->addColumn('permissions', function($row){
                    $actionBtn = "<a href='/panel/admin/users/$row->id/permissions' class='edit btn btn-success btn-sm'>$row->permissions_count صلاحيات</a>";
                    return $actionBtn;
                })
//                ->addIndexColumn()
//                ->addColumn('homeworks', function($row){
//                    $actionBtn = "<a href='/panel/admin/users/$row->id/homeworks' class='edit btn btn-success btn-sm'>$row->permissions_count الواجبات</a>";
//                    return $actionBtn;
//                })
                ->addIndexColumn()
                ->addColumn('roles', function($row){
                    $actionBtn = "<a href='/panel/admin/user/$row->id/roles' class='edit btn btn-primary btn-sm'>$row->roles_count روول</a>";
                    return $actionBtn;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/users/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
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
        return  response()->view('cms.users.create', ['cities' => $cities]);
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
//        dump($request->all());
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:9|unique:users,phone',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required|in:M,F',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'full_name' => $request->get('full_name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'phone' => $request->get('phone'),
                'city_id' => $request->get('city_id'),
                'address' => $request->get('address'),
                'password' => Hash::make('password')
            ];
            $user = User::updateOrCreate(['id' => 0], $data);
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/users/', 'public', 'user_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $user->image()->save($image);
            }else{
                $image = new Image();
                $image->path = 'images/avatar.png';
                $isSaved = $user->image()->save($image);
            }
//            $user->assignRole('user');
            return response()->json(['message' => $isSaved ? 'تم إنشاء المستخدم' : 'خطأ في إنشاء المستخدم', 'id' => $user->id], $isSaved ? 200 : 400);
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
        $user = User::find($id);
        $cities = City::all();
        return response()->view('cms.users.edit', [
            'user'=>$user,
            'cities' => $cities,
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
//        dd($request->all());
        $validator = Validator($request->all(), [
            'full_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits:9|unique:users,phone,'.$id,
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required|in:M,F',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'full_name' => $request->get('full_name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'phone' => $request->get('phone'),
                'city_id' => $request->get('city_id'),
                'address' => $request->get('address'),
            ];
            $user = User::updateOrCreate(['id' => $id], $data);
            if ($request->hasFile('image')) {
                if (isset($user->image)) {
                    Storage::disk('public')->delete($user->image->path);
                }
                $this->uploadFile($request->file('image'), 'images/users/', 'public', 'user_' . time());
                $image = $user->image ?? new Image();
                $image->path = $this->filePath;
                $user->image()->save($image);
            }
            return response()->json(['message' => $user ? 'تم تعديل المستخدم' : 'خطأ في تعديل المستخدم'], $user ? 200 : 400);
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
        $isDeleted = User::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المستخدم' : 'خطأ ف حذف المستخدم'], $isDeleted ? 200:400);
    }

    /**
     * @param Request $request
     * @param $user
     * @return User
     */
    public function userSaveData(Request $request, $user): User
    {
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->gender = $request->get('gender');
        $user->level = $request->get('level');
        $user->city_id = $request->get('city_id');
        $user->address = $request->get('address');
//        $user->teacher_id = $request->get('teacher_id');
        $user->password = Hash::make('password');
        $user->save();
        $user = $user->refresh();
        return $user;
    }
}
