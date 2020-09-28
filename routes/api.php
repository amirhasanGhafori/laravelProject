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

Route::middleware('sanctum:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/V1/auth')->group(function (){

    Route::post('register','API/V01/Auth/AuthController@register')->name('auth.register');
    Route::post('login','API/V01/Auth/AuthController@login')->name('auth.login');

});


//channel routs

Route::prefix('channel')->group(function (){

    Route::get('/all','API/V01/Channel/ChannelController@getAllChannelLists')->name('channel.all');

});
