<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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

    public function changeProfilePage()
    {
        return Inertia::render('Home/Account/ChangeProfile');
    }

    public function destroyPage()
    {
        return Inertia::render('Home/Account/Destroy');
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
        $path = $avatar->storePublicly('avatars', ['disk' => 'public']);

        $this->accountService->updateAccount($request->user(), ['avatar' => $path]);

        return response()->json(success(['avatar' => Storage::url($path)]));
    }

    /**
     * 修改密码
     */
    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ];
        $request->validate($rules);

        if (!Hash::check($request->input('old_password'), $request->user()->password)) {
            throw ValidationException::withMessages(['old_password' => '旧密码错误']);
        }
        $this->accountService->updateAccount($request->user(), ['password' => $request->input('new_password')]);

        return response()->json(success());
    }

    public function changeProfile(Request $request)
    {
        $rules = [
            'username' => ['string', 'min:3', Rule::unique('users')->ignore($request->user()->id)],
            'nickname' => 'string|min:3',
        ];
        $params = $request->validate($rules);

        $this->accountService->updateAccount($request->user(), $params);

        return success();
    }

    /**
     * 注销账户.
     */
    public function destroy(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:6',
        ];
        $request->validate($rules);
        if (!Hash::check($request->input('password'), $request->user()->password)) {
            throw ValidationException::withMessages(['password' => '密码错误']);
        }
        $this->accountService->destroy($request->user());

        return success();
    }
}
