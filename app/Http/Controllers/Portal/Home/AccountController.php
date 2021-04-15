<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AccountController extends Controller
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function changeAvatarPage()
    {
        return Inertia::render('Home/Account/ChangeAvatar');
    }

    public function changePasswordPage()
    {
        return Inertia::render('Home/Account/ChangePassword');
    }

    public function profile(Request $request)
    {
        $user = $request->user()->toArray();

        return response()->json(success($user));
    }

    /**
     * 用户修改头像.
     */
    public function changeAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required|image',
        ];
        $request->validate($rules);

        $avatar = $request->file('avatar');
        $path = $avatar->storePublicly('avatars',['disk'=>'public']);
        $user = $request->user();
        $user->avatar = $path;
        $user->save();

        return response()->json(success(['avatar' => Storage::url($path)]));
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
