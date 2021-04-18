<?php

use App\Http\Controllers\Portal\Auth\LoginController;
use App\Http\Controllers\Portal\Auth\LogoutController;
use App\Http\Controllers\Portal\Auth\RegisterController;
use App\Http\Controllers\Portal\Home\AccountController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [RegisterController::class, 'register']);
Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware([TokenAuthenticate::class])->group(function () {
    /*
     * auth
     */
    Route::post('auth/logout', [LogoutController::class, 'logout']);
    /*
     * account
     */
    Route::get('account/profile', [AccountController::class, 'profile']);
    Route::post('account/avatar/change', [AccountController::class, 'changeAvatar']);
    Route::post('account/password/change', [AccountController::class, 'changePassword']);
    Route::post('account/destroy', [AccountController::class, 'destroy']);
});
