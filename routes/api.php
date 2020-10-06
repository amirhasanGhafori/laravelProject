<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Http\Controllers\API\V01\Auth\AuthController;

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


Route::prefix('v01')->group(function (){
    Route::prefix('auth/')->group(function (){

        Route::post('register',[
            AuthController::class,
            'register'
        ])->name('user.register');

        Route::post('login',[
            AuthController::class,
            'login'
        ])->name('user.login');

        Route::post('logout',[
            AuthController::class,
            'logout'
        ])->name('user.logout');

        Route::get('/user',[
            AuthController::class,
            'user'
        ])->name('user.show');

    });


    Route::prefix('channel/')->group(function (){

        Route::get('/channel',[
            ChannelController::class,
            'getAllChannel'
        ])->name('channel.show');

        Route::middleware(['can:channel management','can:user management','auth:sanctum'])->group(function (){
            Route::post('/create',[
                ChannelController::class,
                'createNewChannel'
            ])->name('channel.create');

            Route::post('/edit',[
                ChannelController::class,
                'editChannel'
            ])->name('channel.edit');

            Route::delete('/delete',[
                ChannelController::class,
                'deleteChannel'
            ])->name('channel.delete');

        });
    });

    Route::resource('/threads',\App\Http\Controllers\API\V01\Thread\ThreadController::class);

    Route::prefix('/threads')->group(function (){

        Route::resource('answers',\App\Http\Controllers\API\V01\Answer\AnswerController::class);

    });

});


//Route Channels


