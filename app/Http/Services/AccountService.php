<?php

namespace App\Http\Services;

use App\Models\User;

class AccountService
{
    public function changeAvatar(User $user, string $avatarPath)
    {
        $user->avatar = $avatarPath;
        $user->save();
    }
}
