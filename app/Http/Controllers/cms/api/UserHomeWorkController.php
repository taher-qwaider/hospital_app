<?php

namespace App\Http\Controllers\cms\api;

use App\Http\Controllers\Controller;
use App\Models\HomeWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        if ($request->expectsJson()){
            $user = Auth::guard('userApi')->user();
            $homeWorks = $user->homeWorks;
            return response()->json(['status'=> true, 'data'=>$homeWorks]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        if ($request->expectsJson()){
            $validator = Validator($request->all(), [
                'date' => 'required|date',
                'saved' => 'required|string',
                'revision' => 'required|string',
                'status' => 'required|string',
                'rate' => 'required|numeric',
                'user_id' => 'required|numeric|exists:users,id'
            ]);
            if(!$validator->fails()){
                if (Auth::guard('userApi')->check())
                    return \response()->json(['message' => 'لا يوجد لديك صلاحية', 'status' => false], 403);
                $homeWork = new HomeWork();
                $homeWork->date = $request->get('date');
                $homeWork->saved = $request->get('saved');
                $homeWork->revision = $request->get('revision');
                $homeWork->status = $request->get('status');
                $homeWork->rate = $request->get('rate');
                $homeWork->user_id= $request->get('user_id');
                $isSaved = $homeWork->save();
                return response()->json([
                   'status' => $isSaved ,
                   'message' => $isSaved ? 'تم الحفظ بنجاح' : 'خطأ في الحفظ'
                ],
                $isSaved ? 201: 400);
            }else
                return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 200);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
