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
  
Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/', [ 'uses' => 'AuthController@index' ])->name('login'); 
    Route::get('login', [ 'uses' => 'AuthController@index' ]);     
    Route::post('login_user', [ 'uses' => 'AuthController@login_user' ]); 
    Route::get('/register', [ 'uses' => 'AuthController@register' ])->name('register'); 
    Route::post('register_user', [ 'uses' => 'AuthController@register_user' ]);
    Route::get('/verification', [ 'uses' => 'AuthController@verification' ])->name('verification')->middleware('auth'); 
    Route::post('verify_user', [ 'uses' => 'AuthController@verify_user' ])->middleware('auth');     
    Route::post('resend_verification', [ 'uses' => 'AuthController@resend_verification' ])->middleware('auth');
    Route::get('forget-password', [ 'uses' => 'AuthController@forget_password' ]); 
    Route::post('forget_password_user', [ 'uses' => 'AuthController@forget_password_user' ]); 
    Route::post('reset_password_user', [ 'uses' => 'AuthController@reset_password_user' ]);  
    Route::get('/intended_view', [ 'uses' => 'AuthController@intended_view' ])->name('intended_view')->middleware('auth'); 
    Route::get('/logout', [ 'uses' => 'AuthController@logout' ])->name('logout');  
    Route::group(['prefix' => 'user', 'middleware' => [ 'auth', 'verified' ] ], function(){
        Route::get('/', [ 'uses' => 'User\UserController@index' ])->name('user.dashboard'); 
    });
});