<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('doctors')->group(function (){
    Route::get('index', [\App\Http\Controllers\cms\api\DoctorController::class, 'index']);
});

Route::prefix('sections')->group(function (){
    Route::get('index', [\App\Http\Controllers\cms\api\SectionController::class, 'index']);
    Route::get('doctors', [\App\Http\Controllers\cms\api\SectionController::class, 'doctors']);
});
Route::get('medicalSections', function (){
    $sections = \App\Models\MedicalSection::all();

    return response()->json(['status' => true,'data' => $sections]);
});

Route::prefix('users')->group(function (){
    Route::get('home', [\App\Http\Controllers\cms\api\HomeController::class, 'home']);
    Route::post('register', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'register']);
    Route::post('forgetPassword', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'forgetPassword']);
//    Route::post('sendReservation/{email}', [\App\Http\Controllers\cms\api\ReservationController::class, 'sendReservationEmail']);
});

Route::prefix('users/auth')->group(function (){
    Route::post('login', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'login']);
});
Route::prefix('users/auth')->group(function (){
    Route::get('logout', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'logout']);
    Route::get('refresh', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'refreshToken']);
    Route::post('sendReservation', [\App\Http\Controllers\cms\api\ReservationController::class, 'sendReservationEmail']);
    Route::get('profile', [\App\Http\Controllers\cms\api\UserProfileController::class, 'get']);
    Route::post('profile', [\App\Http\Controllers\cms\api\UserProfileController::class, 'edit']);
    Route::post('changePassword', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'changePassword']);
});

//Route::prefix('teacher/auth')->group(function (){
//    Route::post('login', [\App\Http\Controllers\cms\api\TeacherApiAuthController::class, 'login']);
//});
//Route::prefix('teacher/auth')->middleware('auth:teacherApi')->group(function (){
//    Route::get('logout', [\App\Http\Controllers\cms\api\TeacherApiAuthController::class, 'logout']);
//});

//Route::middleware('auth:userApi,adminApi,teacherApi')->group(function (){
//    Route::get('home', [\App\Http\Controllers\cms\api\HomeController::class, 'getPosts']);
//
//
//    Route::get('users/chats', [\App\Http\Controllers\cms\api\UserProfileController::class, 'chats']);
//
////    Route::apiResource('users.homeworks', \App\Http\Controllers\cms\api\UserHomeWorkController::class);
//    Route::get('teachers/homeworks', [\App\Http\Controllers\cms\api\UserHomeWorkController::class, 'index']);
//    Route::post('teachers/homeworks', [\App\Http\Controllers\cms\api\UserHomeWorkController::class, 'store']);
//
//    Route::get('teachers/profile', [\App\Http\Controllers\cms\api\TeacherProfileController::class, 'get']);
//    Route::post('teachers/profile', [\App\Http\Controllers\cms\api\TeacherProfileController::class, 'edit']);
//    Route::get('teachers/chats', [\App\Http\Controllers\cms\api\TeacherProfileController::class, 'chats']);
//
//    Route::get('teachers/users', [\App\Http\Controllers\cms\api\TeacherInfoController::class, 'index']);
//});
