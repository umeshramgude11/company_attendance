<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mwadmin\Admin;
use App\Http\Controllers\fronted\Home;
use App\Http\Controllers\mwadmin\CompanyController;
use App\Http\Controllers\mwadmin\UserController;
use Illuminate\Http\Request;
use App\Models\User;
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

//logins
Route::get('/', function (Request $request)
{
    $data['is_company'] = false;
    return view('admin/user/login_page',compact('data'));
});

Route::get('/mwadmin', function (Request $request)
{
    $data['is_company'] = false;
    return view('admin/user/login_page',compact('data'));
});

Route::get('/company_login', function (Request $request)
{
    $data['is_company'] = true;
    return view('admin/user/login_page',compact('data'));
});
Route::post('/mwadmin', [App\Http\Controllers\mwadmin\Admin::class, 'index']);


// after login pages
Route::group(['middleware'=>'admin_auth'],function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/logout', [App\Http\Controllers\mwadmin\Admin::class, 'logout']);
    Route::get('/attendance', [App\Http\Controllers\mwadmin\UserController::class, 'attendance']);
    Route::get('/mark_attendance', [App\Http\Controllers\mwadmin\UserController::class, 'attendance_store']);
    Route::get('/user_attendance/{id}', [App\Http\Controllers\mwadmin\UserController::class, 'user_attendance']);

    Route::resource('company', CompanyController::class);

    Route::resource('user', UserController::class);
    Route::view('dashboard','home');

    // Route::get('/ip_access/{id}', function ($id)
    // {
    //     $data['user_data'] =  User::select('*')
    //     ->where('id', $id)
    //     ->first();
    //     Route::view('dashboard','home');
    // });
    Route::get('/ip_access/{id}', [App\Http\Controllers\mwadmin\UserController::class, 'ip_access']);
    Route::post('/add_ip_access', [App\Http\Controllers\mwadmin\UserController::class, 'add_ip_access']);
});




// Auth::routes();
