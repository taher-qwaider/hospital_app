<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    public function index(){
        $data['status'] = true;
        $data['data'] = Doctor::all();

        return response()->json($data);

    }
}
