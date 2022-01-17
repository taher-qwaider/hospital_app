<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //

    public function index(){
        $data['sections'] = Section::all();

        return response()->json($data);

    }
}
