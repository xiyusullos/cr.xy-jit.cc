<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'codes'], function () {
    // 发送邮箱验证码
    Route::post('/', 'CodesController@store');
});

Route::group(['prefix' => 'users'], function () {
    // 注册 without token
    Route::post('/', 'UsersController@store');
    // 登录 with email and password
    Route::post('/login', 'UsersController@login');
    // 查看个人信息 with token
    Route::get('/{id}', 'UsersController@show');
    // 修改个人信息 with token
    Route::put('/{id}', 'UsersController@update');
    // 重置密码 without token
    Route::put('/resetPassword', 'UsersController@resetPassword');
});


Route::group(['prefix' => 'classrooms'], function () {
    // 当前可用教室查看、筛选可用教室
    Route::get('/', 'ClassroomsController@index');
});

Route::group(['prefix' => 'reservations'], function () {
    // 我的租赁教室
    Route::get('/', 'ReservationsController@index');
    // 租赁教室
    Route::post('/', 'ReservationsController@store');
    // 归还教室
    Route::delete('/{id}', 'ReservationsController@destroy');
});

// Route::resource('codes', 'CodesController');
// Route::resource('users', UsersController::class);
// Route::resource('classrooms', 'ClassroomsController');
// Route::resource('reservations', 'ReservationsController');
