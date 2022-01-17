<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    public function index(){
        $data['doctors'] = Doctor::all();

        return response()->json($data);

    }
}
