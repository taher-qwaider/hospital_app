<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Post;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
//    public function getPosts(Request $request){
//        if ($request->expectsJson()){
//            $posts = Post::orderBy('created_at')->get();
//            return response()->json(['status' => true, 'data' => $posts]);
//        }
//    }
    public function home(){
        $data['status'] = true;
        $data['data']['sections'] = Section::all();
        $data['data']['doctors'] = Doctor::all();
        $data['data']['settings'] = Setting::all();

        return response()->json($data);


    }

}
