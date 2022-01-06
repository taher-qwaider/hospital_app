<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\HomeWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use PDF;
class UserHomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return Response
     */
    public function index(User $user)
    {
        //
        return \response()->view('cms.homeworks.index', ['user' => $user]);

    }
    public function gethomeworks(Request $request, User $user){
//        if ($request->ajax()) {
            return DataTables::of($user->homeWorks)
                ->make(true);
//        }
    }
    public function getPdf($userId){
        $user = User::find($userId);
        $homeWorks = $user->homeworks->take(7);
        $pdf = PDF::loadView('cms.print', ['homeWorks'=> $homeWorks, 'user'=>$user]);
        return $pdf->download('homeWorks.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(User $user)
    {
        //lnkn
        return \response()->view('cms.homeworks.create', ['user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'saved' => 'required|string|min:3',
            'revision' => 'required|string|min:3',
            'status' => 'required|string|in:A,N,M',
            'rate' => 'required|numeric|min:1|max:5',
            'date' => 'required|date'
        ]);
        if (!$validator->fails()){
            $homeWork = new HomeWork();
            $homeWork->user_id = $user->id;
            $homeWork->date = $request->get('date');
            $homeWork->saved = $request->get('saved');
            $homeWork->revision = $request->get('revision');
            $homeWork->rate = $request->get('rate');
            $homeWork->status = $request->get('status');
            $isSaved = $homeWork->save();

            return response()->json(['message' => $isSaved ? 'تم إنشاء بنجاح' : 'خطأ في إنشاء'], $isSaved ? 200 : 400);
        }else
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
