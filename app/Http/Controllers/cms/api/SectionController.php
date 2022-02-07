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
        $data['status'] = true;
        $data['data'] = Section::all();
        return response()->json($data);

    }

    public function doctors($id)
    {
        $section = Section::where('id', $id)->with('doctors')->first();
        $doctors = $section->doctors;

        return response()->json(['status' => true,'data' => $doctors]);
    }
}
