<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return $request->user()->toArray();
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ];
        $request->validate($rules);
        $user = $request->user();

        if (!Hash::check($request->input('old_password'), $request->user()->password)) {
            throw ValidationException::withMessages(['old_password' => '旧密码错误']);
        }
        $user->password = $request->input('new_password');
        $user->save();

        return response()->json(success());
    }
}
