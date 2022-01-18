<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //

    public function index(){
        $data['sections'] = Section::all();
        $data['status'] = true;
        return response()->json($data);

    }

    public function doctors($id)
    {
        $section = Section::where('id', $id)->first();
        $doctors = $section->doctors;

        return response()->json(['status' => true,'doctors' => $doctors]);
    }
}
