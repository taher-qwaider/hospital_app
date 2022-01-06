<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('cms.cities.index');
    }

    public function getCites(){
        $cities = City::all();
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3'
        ]);
        if (!$validator->fails()){
            $city = new City();
            $city->name =$request->name;
            $isSaved = $city->save();
            return response()->json(['message' => $isSaved ? 'تم إنشاء المدينة': 'خطأ في إنشاء المدينة'], $isSaved ? 200:400);
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
        $city = City::find($id);
        return response()->view('cms.cities.edit',['city'=>$city]);
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
//        dd($request->all());
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3'
        ]);
        if (!$validator->fails()){
            $city = City::find($id);
            $city->name =$request->name;
            $isSaved = $city->save();
            return response()->json(['message' => $isSaved ? 'تم تعديل المدينة': 'خطأ في تعديل المدينة'], $isSaved ? 200:400);
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
        $isDeleted = City::destroy($id);
        return response()->json(['message' => $isDeleted ? 'تم حذف المدينة' : 'خطأ ف حذف المدينة'], $isDeleted ? 200:400);
    }
}
