<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function getPosts(Request $request){
        if ($request->expectsJson()){
            $posts = Post::orderBy('created_at')->get();
            return response()->json(['status' => true, 'data' => $posts]);
        }
    }
}
