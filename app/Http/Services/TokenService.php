<?php

namespace App\Http\Services;

use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Str;

class TokenService
{
    /**
     * @param User $user 用户
     *
     * @return Token
     */
    public function createToken(User $user)
    {
        $token = new Token();
        $token->user_id = $user->id;
        $token->access_token = $this->generateToken($user);
        $token->save();

        return $token;
    }

    public function getToken(string $accessToken)
    {
        return Token::query()->where('access_token', $accessToken)->first();
    }

    private function generateToken(User $user)
    {
        return Str::random();
    }
}
