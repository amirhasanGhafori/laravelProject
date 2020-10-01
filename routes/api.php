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


//Route Channels

Route::prefix('v01/channel/')->group(function (){

    Route::get('/channel','App\Http\Controllers\API\V01\Channel\ChannelController@getAllChannel')->name('channel.show');
    Route::post('/create','App\Http\Controllers\API\V01\Channel\ChannelController@createNewChannel')->name('channel.create');

});

