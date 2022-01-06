<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $subject
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
        //
        if ($subject == 'general'){
            $generals = Setting::where('subject', 'general')->get();
            return response()->view('cms.settings.general', ['generals' => $generals, 'subject' =>$subject]);
        }elseif ($subject == 'social'){
            $socials = Setting::where('subject', 'social')->get();
            return response()->view('cms.settings.socials', ['socials' => $socials, 'subject' =>$subject]);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $subject)
    {
        //
//        dd($request->all());
        foreach ($request->all() as $key =>$value){
            $social = Setting::where('key', $key)->first();
            $social->value = $value;
            $social->save();
        }
        return response()->json(['message' => 'تم التحديث بناجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
