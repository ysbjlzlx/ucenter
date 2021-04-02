<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerForm()
    {
        return view('portal.auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
        $request->validate($rules);
        $user = $this->userService->createUser($request->input('email'), $request->input('password'), $request->all());
        Auth::login($user);

        return redirect()->route('home');
    }
}
