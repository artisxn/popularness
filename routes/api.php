<?php

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

//Route::group(['prefix'=> 'otc/v1','namespace'=> 'Api_v1'],function(){
//    Route::resource('/users','UsersController');
//
//});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('resend_email', 'AuthController@resendEmail');
    Route::post('find_or_create', 'AuthController@findOrCreate');
    Route::post('login_with', 'AuthController@loginWith');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

//Route::fallback(function(){
//    return response()->json([
//        'status_code'=>404,
//        'status'=> 'error',
//        'message'=> "You're trying with wrong end point, please contact with API provider",
//    ]);
//});

