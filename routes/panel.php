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
Route::get('storage/link', function (){
    \Illuminate\Support\Facades\Artisan::call('Storage:link');
});

Route::prefix('admin')->middleware('auth:admin')->group(function (){
    Route::get('/', function () {

//        $data['users_count'] = \Illuminate\Support\Facades\Auth::guard('admin')->user()->users->count();
//        $data['teachers_count'] = \Illuminate\Support\Facades\Auth::guard('admin')->user()->teachers->count();
//        $data['posts_count'] = \Illuminate\Support\Facades\Auth::guard('admin')->user()->posts->count();
        $data = [];

        return view('cms.dashboard', $data);
    })->name('dashboard');

    Route::get('profile', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'profile'])->name('auth.profile');
    Route::get('changePassword', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'changePassword'])->name('changePassword');
    Route::post('changePassword', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'savePassword']);

    Route::post('image/store', [\App\Http\Controllers\cms\ImageController::class, 'store'])->name('image.store');

    Route::resource('doctors', \App\Http\Controllers\cms\DoctorController::class)->middleware('permission:show_doctors');
    Route::get('doctor/list', [\App\Http\Controllers\cms\DoctorController::class, 'getDoctor'])->name('doctors.list')->middleware('permission:show_doctors');
    Route::post('doctors/{doctor}/update', [\App\Http\Controllers\cms\DoctorController::class, 'update'])->middleware('permission:edit_doctors')->name('doctors.update');

    Route::resource('sections', \App\Http\Controllers\cms\SectionController::class)->middleware('permission:show_sections');
    Route::get('section/list', [\App\Http\Controllers\cms\SectionController::class, 'getSections'])->name('sections.list')->middleware('permission:show_sections');
    Route::post('sections/{section}/update', [\App\Http\Controllers\cms\SectionController::class, 'update'])->middleware('permission:edit_sections')->name('sections.update');

    Route::resource('users', \App\Http\Controllers\cms\UserController::class)->middleware('permission:edit_users');
    Route::post('users/{user}/update', [\App\Http\Controllers\cms\UserController::class, 'update'])->middleware('permission:edit_users');
    Route::get('user/list', [\App\Http\Controllers\cms\UserController::class, 'getUsers'])->name('user.list')->middleware('permission:read_users');
    Route::get('users/{user}/permissions', [\App\Http\Controllers\cms\spatie\UserPermissionController::class, 'permission'])->middleware('permission:edit_users');
    Route::post('users/permissions', [\App\Http\Controllers\cms\spatie\UserPermissionController::class, 'store'])->middleware('permission:edit_users')->name('users.permission.store');
    Route::resource('users.homeworks', \App\Http\Controllers\cms\UserHomeWorkController::class)->middleware('permission:edit-home-work');
    Route::get('user/{user}/homeworks/list', [\App\Http\Controllers\cms\UserHomeWorkController::class, 'gethomeworks'])->middleware('permission:read-home-work')->name('user.homework.list');
    Route::get('user/{user}/homeworks/print', [\App\Http\Controllers\cms\UserHomeWorkController::class, 'getPDF'])->name('users.homework.pdf');

    Route::resource('admins', \App\Http\Controllers\cms\AdminController::class)->middleware('permission:edit-admins');
    Route::post('admins/{admin}/update', [\App\Http\Controllers\cms\AdminController::class, 'update'])->middleware('permission:edit-admins');
    Route::get('admin/list', [\App\Http\Controllers\cms\AdminController::class, 'getAdmins'])->name('admin.list')->middleware('permission:read-admins');
    Route::get('admins/{admin}/permissions', [\App\Http\Controllers\cms\spatie\AdminPermissionController::class, 'permission'])->middleware('permission:edit-admins')->name('admin.permissions');
    Route::post('admins/{admin}/permissions', [\App\Http\Controllers\cms\spatie\AdminPermissionController::class, 'store'])->middleware('permission:edit-admins');

    Route::resource('teachers', \App\Http\Controllers\cms\TeacherController::class)->middleware('permission:edit-teachers');
    Route::post('teachers/{teacher}/update', [\App\Http\Controllers\cms\TeacherController::class, 'update'])->middleware('permission:edit-teachers')->name('teacher.data.update');
    Route::get('teacher/list', [\App\Http\Controllers\cms\TeacherController::class, 'getTeachers'])->middleware('permission:read-teachers')->name('teacher.list');
    Route::get('teachers/{teacher}/permissions', [\App\Http\Controllers\cms\spatie\TeacherPermissionController::class, 'permission'])->middleware('permission:edit-teachers');
    Route::post('teachers/permissions', [\App\Http\Controllers\cms\spatie\TeacherPermissionController::class, 'store'])->middleware('permission:edit-teachers')->name('teacher.permissions.store');

    Route::resource('permissions', \App\Http\Controllers\cms\spatie\PermissionController::class)->middleware('permission:edit-permissions');
    Route::get('permission/list', [\App\Http\Controllers\cms\spatie\PermissionController::class, 'getPermissions'])->middleware('permission:edit-permissions')->name('permission.list');

    Route::resource('roles', \App\Http\Controllers\cms\spatie\RoleController::class)->middleware('permission:edit-roles');
    Route::get('role/list', [\App\Http\Controllers\cms\spatie\RoleController::class, 'getRoles'])->middleware('permission:edit-roles')->name('role.list');
    Route::get('roles/{role}/permissions', [\App\Http\Controllers\cms\spatie\RolePermissionController::class, 'permission'])->middleware('permission:edit-roles');
    Route::post('roles/{role}/permissions', [\App\Http\Controllers\cms\spatie\RolePermissionController::class, 'store'])->middleware('permission:edit-roles');

    Route::get('logout',[ \App\Http\Controllers\cms\auth\AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::resource('cities', \App\Http\Controllers\cms\CityController::class)->middleware('permission:edit-cities');
    Route::get('city/list', [\App\Http\Controllers\cms\CityController::class, 'getCites'])->middleware('permission:edit-cities')->name('city.list');

    Route::resource('posts', \App\Http\Controllers\cms\PostController::class)->middleware('permission:edit-posts');
    Route::get('post/list', [\App\Http\Controllers\cms\PostController::class, 'getPosts'])->middleware('permission:edit-posts')->name('post.list');
    Route::post('posts/{post}/update', [\App\Http\Controllers\cms\PostController::class, 'update'])->middleware('permission:edit-posts');

    Route::get('messages', [\App\Http\Controllers\cms\MessageController::class, 'index'])->middleware('permission:read-messages')->name('messages.index');
    Route::get('messages/{message}/markRead',[\App\Http\Controllers\cms\MessageController::class, 'markRead'])->middleware('permission:read-messages');

    Route::get('settings/{subject}', [\App\Http\Controllers\cms\SettingController::class, 'index'])->middleware('Permission:read-settings')->name('settings.index');
    Route::put('settings/{subject}', [\App\Http\Controllers\cms\SettingController::class, 'update'])->middleware('Permission:edit-settings')->name('settings.save');
});

Route::prefix('admin')->middleware('guest:admin')->group(function (){
    Route::get('login', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'view'])->name('admin.login.view');
    Route::post('login', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'login']);
    Route::get('forgetPassword', [\App\Http\Controllers\cms\auth\AdminAuthController::class, 'forgetPassword'])->name('forgetPassword');

});
