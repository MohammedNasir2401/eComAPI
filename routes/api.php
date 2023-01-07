<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)
    ->prefix('user')->group(function () {
        Route::post('register', 'register');
        Route::post('login','login');
        Route::post('vendorRegistration','vendorRegistration');
        Route::post('vendorLogin','vendorLogin');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('tokenLogin','tokenLogin');
            Route::post('logout','logout');
        });

    });
