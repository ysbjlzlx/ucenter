<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function createUser(string $username, string $password, array $extra): User
    {
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->save();

        return $user;
    }
}
