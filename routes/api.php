<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [RegisterController::class, 'register']);
Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware([TokenAuthenticate::class])->group(function () {
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::post('user/password/change', [UserController::class, 'changePassword']);
});
