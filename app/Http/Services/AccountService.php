<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Arr;

class AccountService
{
    public function updateAccount(User $user, array $data)
    {
        if (Arr::has($data, 'avatar')) {
            $user->avatar = Arr::get($data, 'avatar');
        }
        if (Arr::has($data, 'password')) {
            $user->password = Arr::get($data, 'password');
        }
        $user->save();

        return $user;
    }

    /**
     * 注销账户.
     */
    public function destroy(User $user)
    {
        // 删除用户的登录记录
        $user->tokens()->delete();
        // 删除用户本身
        $user->delete();

        return true;
    }
}
