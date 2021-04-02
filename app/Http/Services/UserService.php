<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function createUser(string $email, string $password, array $extra): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }
}
