<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('users/changePassword/{token}', [\App\Http\Controllers\cms\auth\ForgetPasswordController::class, 'changeForgetPassword'])
    ->name('user.password.reset');

Route::get('users/resetPassword/{token}', [\App\Http\Controllers\cms\auth\ForgetPasswordController::class, 'resetForgetPassword'])
    ->name('password.reset');
