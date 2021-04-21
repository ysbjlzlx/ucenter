<?php

use App\Http\Controllers\Portal\Auth\LoginController;
use App\Http\Controllers\Portal\Auth\RegisterController;
use App\Http\Controllers\Portal\Home\AccountController;
use App\Http\Controllers\Portal\Home\HomeController;
use App\Http\Controllers\Portal\Home\ProfileController;
use App\Http\Controllers\Portal\IndexController;
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

Route::any('/', [IndexController::class, 'index']);

Route::get('/login', [LoginController::class, 'loginForm']);
Route::get('/register', [RegisterController::class, 'registerForm']);

Route::middleware('web')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home.home');
    Route::get('/profile', [profileController::class, 'profilePage'])->name('home.profile');
    /*
     * account
     */
    Route::get('/home/account/password/change', [AccountController::class, 'changePasswordPage']);
    Route::get('/home/account/avatar/change', [AccountController::class, 'changeAvatarPage']);
    Route::get('/home/account/profile/change', [AccountController::class, 'changeProfilePage']);
    Route::get('/home/account/destroy', [AccountController::class, 'destroyPage']);
});
