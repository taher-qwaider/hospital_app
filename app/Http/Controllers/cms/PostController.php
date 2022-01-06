<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
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
        return response()->view('cms.posts.index');
    }

    public function getPosts(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Post::all())
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/panel/admin/posts/$row->id/edit' class='edit btn btn-success btn-sm'>Edit</a> <button onclick='showAlert($row->id)' class='delete btn btn-danger btn-sm'>Delete</button>";
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
        return response()->view('cms.posts.create');
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
            'title' => 'required|string|min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if (!$validator->fails()){
            $post = new Post();
            $post->title = $request->get('title');
            $post->admin_id = Auth::guard('admin')->user()->id;
            $isSaved = $post->save();
            $post = $post->refresh();
            if ($request->hasFile('image')) {
                $this->uploadFile($request->file('image'), 'images/posts/', 'public', 'post_' . time() . '.jpg');
                $image = new Image();
                $image->path = $this->filePath;
                $isSaved = $post->image()->save($image);
            }
            return response()->json(['message' => $isSaved ? 'تم إنشاء المنشور' : 'خطأ في إنشاء المنشور', 'id' => $post->id], $isSaved ? 200 : 400);
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
        $post = Post::find($id);
        return response()->view('cms.posts.edit',['post' => $post]);
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
//            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if (!$validator->fails()){
            $post = Post::find($id);
            $post->title = $request->get('title');
            $isSaved = $post->save();
            $post = $post->refresh();
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($post->image->path);
                $this->uploadFile($request->file('image'), 'images/posts/', 'public', 'post_' . time() . '.jpg');
                $image = $post->image;
                $image->path = $this->filePath;
                $post->image()->save($image);
            }
            return response()->json(['message' => $isSaved ? 'تم تحديث المنشور' : 'خطأ في تحديث المنشور', 'id' => $post->id], $isSaved ? 200 : 400);
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
        $isDeleted = Post::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المنشور' : 'خطأ ف حذف المنشور'], $isDeleted ? 200:400);
    }
}
