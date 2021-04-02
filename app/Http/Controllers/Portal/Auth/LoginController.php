<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Events\UserLoginSuccess;
use App\Http\Controllers\Controller;
use App\Http\Services\TokenService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function loginForm()
    {
        return view('portal.auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ];
        $request->validate($rules);
        $user = User::query()->where('email', $request->input('email'))->first();
        if (empty($user)) {
            throw ValidationException::withMessages(['email' => '用户不存在']);
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages(['password' => '密码错误']);
        }
        // 登录成功
        event(new UserLoginSuccess($user));
        // 
        Auth::login($user);

        return redirect()->route('home');
    }
}
