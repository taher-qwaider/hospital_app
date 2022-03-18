<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\MedicalSection;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicalSectionControlller extends Controller
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
        return response()->view('cms.medaicalSection.index');
    }


    public function getMedicalSections(Request $request){
        if ($request->ajax()) {
            return DataTables::of(MedicalSection::all())
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/medicalSections/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
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
        return response()->view('cms.medaicalSection.create');
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
            'body' => 'required|string|min:3',
        ]);
        if (!$validator->fails()){
            $data = [
                'name' => $request->get('name'),
                'body' => $request->get('body'),
            ];
            $section = MedicalSection::updateOrCreate(['id' => 0], $data);
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

            return response()->json(['message' => $isSaved ? 'تم إنشاء بنجاج' : 'خطأ في إنشاء'], $isSaved ? 200 : 400);
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
        $data['medicalSection'] = MedicalSection::find($id);
        return response()->view('cms.medaicalSection.edit', $data);

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
            'body' => 'required|string|min:3',
        ]);
        if (!$validator->fails()){
            $data = [
                'name' => $request->get('name'),
                'body' => $request->get('body'),
            ];
            $section = MedicalSection::updateOrCreate(['id' => $id], $data);
            if ($request->hasFile('image')) {
                $section->image()->delete();

                $this->uploadFile($request->file('image'), 'images/sections/', 'public', 'section_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $section->image()->save($image);
            }

            return response()->json(['message' => $isSaved ? 'تم الخفظ بنجاج' : 'خطأ في إنشاء'], $isSaved ? 200 : 400);
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
        $isDeleted = MedicalSection::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف بنجاج' : 'خطأ ف حذف'], $isDeleted ? 200:400);
    }
}
