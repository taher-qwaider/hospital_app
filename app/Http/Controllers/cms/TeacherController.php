<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Image;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
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
        return response()->view('cms.teachers.index');
    }

    public function getTeachers(Request $request)
    {
//        if ($request->ajax()) {
            return DataTables::of(Auth::guard('admin')->user()->teachers()->with(['admin', 'city'])->get())
                ->addIndexColumn()
                ->addColumn('permissions', function($row){
                    $actionBtn = "<a href='/panel/admin/teachers/$row->id/permissions' class='edit btn btn-success btn-sm'>$row->permissions_count صلاحيات</a>";
                    return $actionBtn;
                })
                ->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('roles', function($row){
                    $actionBtn = "<a href='/panel/admin/teachers/$row->id/roles' class='edit btn btn-primary btn-sm'>$row->roles_count روول</a>";
                    return $actionBtn;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/teachers/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
                    return $actionBtn;
                })
                ->rawColumns(['action', 'permissions', 'roles'])
                ->make(true);
//        }
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
        return response()->view('cms.teachers.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|digits:9|unique:teachers,phone',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required|in:M,F',
            'teach_level' => 'required|in:A,B,C',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $teacher = new Teacher();
            $teacher = $this->saveData($request, $teacher);
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/teachers/', 'public', 'teach_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $teacher->image()->save($image);
            }else{
                $image = new Image();
                $image->path = 'images/avatar.png';
                $isSaved = $teacher->image()->save($image);
            }
            $teacher->assignRole('teacher');
            return response()->json(['message' => $teacher ? 'تم إنشاء المحفظ' : 'خطأ في إنشاء المحفظ', 'id' => $teacher->id], $teacher ? 200 : 400);
        } else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $teacher = Teacher::find($id);
        $cities = City::all();
        return response()->view('cms.teachers.edit', [
            'teacher'=>$teacher,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:teachers,email,'.$id,
            'phone' => 'required|digits:9|unique:teachers,phone,'.$id,
//            'image' => 'sometimes',
            'gender' => 'required|in:M,F',
            'teach_level' => 'required|in:A,B,C',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $teacher = Teacher::find($id);
            $teacher = $this->saveData($request, $teacher);

            if ($request->hasFile('image')) {
                if ($teacher->image){
                    Storage::disk('public')->delete($teacher->image->path);
                }
                $this->uploadFile($request->file('image'), 'images/users/', 'public', 'user_' . time());
                $image = $teacher->image ?? new Image();
                $image->path = $this->filePath;
                $isSaved = $teacher->image()->save($image);
            }
            return response()->json(['message' => 'تم تعديل المحفظ']    );
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $isDeleted = Teacher::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المحفظ' : 'خطأ ف حذف المحفظ'], $isDeleted ? 200:400);
    }

    /**
     * @param Request $request
     * @param $teacher
     * @return Teacher
     */
    public function saveData(Request $request, $teacher): Teacher
    {
        $teacher->first_name = $request->get('first_name');
        $teacher->last_name = $request->get('last_name');
        $teacher->email = $request->get('email');
        $teacher->phone = $request->get('phone');
        $teacher->gender = $request->get('gender');
        $teacher->teach_level = $request->get('teach_level');
        $teacher->city_id = $request->get('city_id');
        $teacher->address = $request->get('address');
        $teacher->admin_id = Auth::guard('admin')->user()->id;
        $teacher->password = Hash::make('password');
        $teacher->save();
        $teacher = $teacher->refresh();
        return $teacher;
    }
}
