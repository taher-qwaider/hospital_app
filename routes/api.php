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
});

Route::prefix('users')->group(function (){
    Route::get('register', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'register']);
//    Route::post('sendReservation/{email}', [\App\Http\Controllers\cms\api\ReservationController::class, 'sendReservationEmail']);
});

Route::prefix('user/auth')->group(function (){
    Route::post('login', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'login']);
});
Route::prefix('user/auth')->middleware('auth:userApi')->group(function (){
    Route::get('logout', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'logout']);
    Route::get('refresh', [\App\Http\Controllers\cms\api\UserApiAuthController::class, 'refreshToken']);
    Route::post('sendReservation/{email}', [\App\Http\Controllers\cms\api\ReservationController::class, 'sendReservationEmail']);
    Route::get('users/profile', [\App\Http\Controllers\cms\api\UserProfileController::class, 'get']);
    Route::post('users/profile', [\App\Http\Controllers\cms\api\UserProfileController::class, 'edit']);
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
