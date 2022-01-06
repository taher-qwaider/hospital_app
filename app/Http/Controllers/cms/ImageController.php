<?php

namespace App\Http\Controllers\cms;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use FileUpload;
    //

    public function store(Request $request){
//        dump($request->all());
        $validator = Validator($request->all(), [
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        if (!$validator->fails()){
            if ($request->hasFile('file')){
                $this->uploadFile($request->file('file'), 'images/users/', 'public', 'user_'.time().'jpg');
                $image = new Image();
                $image->path = $this->filePath;
                $image->save();
                $image = $image->refresh();
                return response()->json(['message' => 'تم رفع الصورة بنجاح', 'image_id']);
            }
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }
}
