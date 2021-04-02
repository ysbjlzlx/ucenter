<?php

use App\Http\Controllers\Portal\Auth\LoginController;
use App\Http\Controllers\Portal\Auth\RegisterController;
use App\Http\Controllers\Portal\Home\HomeController;
use App\Http\Controllers\Portal\Home\ProfileController;
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

Route::get('/login', [LoginController::class, 'loginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'registerForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('web')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home.home');
    Route::get('/profile', [profileController::class, 'profile'])->name('home.profile');
});
