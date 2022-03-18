<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventControlller extends Controller
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
        return response()->view('cms.event.index');
    }

    public function getEvents(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Event::all())
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/events/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
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
        return response()->view('cms.event.create');
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
//        dd($request->all());
        $validator = Validator  ($request->all(), [
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
        ]);
        if (!$validator->fails()){
            $data = [
                'title' => $request->get('title'),
                'body' => $request->get('body'),
            ];
            $event = Event::updateOrCreate(['id' => 0], $data);
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/events/', 'public', 'events_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $event->image()->save($image);
            }else{
                $image = new Image();
                $image->path = 'images/event_avatar.png';
                $isSaved = $event->image()->save($image);
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
        $data['event'] = Event::find($id);
        return response()->view('cms.event.edit', $data);
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
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
        ]);
        if (!$validator->fails()){
            $data = [
                'title' => $request->get('title'),
                'body' => $request->get('body'),
            ];
            $event = Event::updateOrCreate(['id' => $id], $data);
            if ($request->hasFile('image')) {
                $event->image()->delete();
                $this->uploadFile($request->file('image'), 'images/events/', 'public', 'events_' . time());
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $event->image()->save($image);
            }

            return response()->json(['message' => $isSaved ? 'تم حفظ بنجاج' : 'خطأ في إنشاء'], $isSaved ? 200 : 400);
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
        $isDeleted = Event::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف بنجاح' : 'خطأ ف حذف '], $isDeleted ? 200:400);
    }
}
