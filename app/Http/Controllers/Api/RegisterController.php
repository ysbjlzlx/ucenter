<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $rules = [
            'username' => 'required|string|between:3,16',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
        $request->validate($rules);
        $user = $this->userService->createUser($request->input('username'), $request->input('password'), $request->all());

        return $user;
    }
}
