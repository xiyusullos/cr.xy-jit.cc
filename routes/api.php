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

Route::group(['prefix' => 'users'], function () {
    // 注册
    Route::post('/', 'UsersController@store');
    // 登录 ?
    Route::post('/login', 'UsersController@login');
    // 查看个人信息 with token
    Route::get('/{id}', 'UsersController@show');
    // 修改个人信息 with token
    Route::put('/{id}', 'UsersController@update');
    // 重置密码 without token
    Route::put('/resetPassword', 'UsersController@resetPassword');
    // Route::resource('/users', UsersController::class);
});

Route::group(['prefix' => 'classrooms'], function () {
    Route::get('/', 'ClassroomsController@index');
});

Route::resource('classrooms', 'ClassroomsController');
Route::resource('reservations', 'ReservationsController');
