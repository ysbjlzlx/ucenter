<?php

namespace App\Http\Controllers\Api;

use App\Events\UserLoginSuccess;
use App\Http\Controllers\Controller;
use App\Http\Services\TokenService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ];
        $request->validate($rules);
        $user = User::query()->where('username', $request->input('username'))->first();
        if (empty($user)) {
            throw ValidationException::withMessages(['username' => '用户不存在']);
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages(['password' => '密码错误']);
        }
        // 登录成功
        $token = $this->tokenService->createToken($user);
        event(new UserLoginSuccess($user));

        return response()->json(success(['access_token' => $token->access_token]));
    }
}
