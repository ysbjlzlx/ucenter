<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [RegisterController::class, 'register']);
Route::post('auth/login', [LoginController::class, 'login']);
