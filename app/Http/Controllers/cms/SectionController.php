<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use Yajra\DataTables\DataTables;

class SectionController extends Controller
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
        return response()->view('cms.section.index');
    }

    public function getSections(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Section::all())
//                ->addIndexColumn()
//                ->addColumn('permissions', function($row){
//                    $actionBtn = "<a href='/panel/admin/users/$row->id/permissions' class='edit btn btn-success btn-sm'>$row->permissions_count صلاحيات</a>";
//                    return $actionBtn;
//                })
//                ->addIndexColumn()
//                ->addColumn('homeworks', function($row){
//                    $actionBtn = "<a href='/panel/admin/users/$row->id/homeworks' class='edit btn btn-success btn-sm'>$row->permissions_count الواجبات</a>";
//                    return $actionBtn;
//                })
//                ->addIndexColumn()
//                ->addColumn('roles', function($row){
//                    $actionBtn = "<a href='/panel/admin/user/$row->id/roles' class='edit btn btn-primary btn-sm'>$row->roles_count روول</a>";
//                    return $actionBtn;
//                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/sections/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
//        $cities = City::all();
        return  response()->view('cms.section.create');
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
            'name' => 'required|string|min:3',
//            'email' => 'required|email|unique:sections,email',
//            'phone' => 'required|digits:9|unique:sections,phone',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
//            'gender' => 'required|in:M,F',
//            'city_id' => 'required|numeric|exists:cities,id',
//            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'name' => $request->get('name'),
//                'email' => $request->get('email'),
//                'gender' => $request->get('gender'),
//                'phone' => $request->get('phone'),
//                'city_id' => $request->get('city_id'),
//                'address' => $request->get('address'),

            ];
            $section = Section::updateOrCreate(['id' => 0], $data);
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/sections/', 'public', 'section_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $section->image()->save($image);
            }else{
                $image = new Image();
                $image->path = 'images/section_avatar.png';
                $isSaved = $section->image()->save($image);
            }
//            $user->assignRole('user');
            return response()->json(['message' => $isSaved ? 'تم إنشاء المستخدم' : 'خطأ في إنشاء المستخدم'], $isSaved ? 200 : 400);
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
        $section = Section::find($id);
        $cities = City::all();
        return response()->view('cms.section.edit', [
            'section'=>$section,
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
            'name' => 'required|string|min:3',
//            'email' => 'required|email|unique:sections,email,'.$id,
//            'phone' => 'required|digits:9|unique:sections,phone,'.$id,
//            'image' => 'required|image|mimes:jpg,jpeg,png',
//            'gender' => 'required|in:M,F',
//            'city_id' => 'required|numeric|exists:cities,id',
//            'address' => 'required|string',
        ]);
        if (!$validator->fails()){
            $data = [
                'name' => $request->get('name'),
//                'email' => $request->get('email'),
//                'gender' => $request->get('gender'),
//                'teacher_id' => $request->get('teacher_id'),
//                'phone' => $request->get('phone'),
//                'city_id' => $request->get('city_id'),
//                'address' => $request->get('address'),
            ];
            $user = Section::updateOrCreate(['id' => $id], $data);
            if ($request->hasFile('image')) {
                if (isset($user->image)) {
                    Storage::disk('public')->delete($user->image->path);
                }
                $this->uploadFile($request->file('image'), 'images/sections/', 'public', 'section_' . time());
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
        $isDeleted = Section::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المستخدم' : 'خطأ ف حذف المستخدم'], $isDeleted ? 200:400);
    }

}
