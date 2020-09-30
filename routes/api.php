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


Route::prefix('v01/auth/')->group(function (){

    Route::post('register','App\Http\Controllers\API\V01\Auth\AuthController@register')->name('user.register');
    Route::post('login','App\Http\Controllers\API\V01\Auth\AuthController@login')->name('user.login');
    Route::post('logout','App\Http\Controllers\API\V01\Auth\AuthController@logout')->name('user.logout');
    Route::get('/user','App\Http\Controllers\API\V01\Auth\AuthController@user')->name('user.show');


});

