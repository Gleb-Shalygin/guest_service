<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\HeaderMiddleware;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware([ApiMiddleware::class, HeaderMiddleware::class])->group(function () {
    Route::group(['prefix' => 'guest'], function () {
        Route::post('create', [GuestController::class, 'create']);
        Route::post('update', [GuestController::class, 'update']);
        Route::post('delete', [GuestController::class, 'delete']);
        Route::get('get/{guest}', [GuestController::class, 'get']);
        Route::get('get', [GuestController::class, 'getAll']);
    });
});
