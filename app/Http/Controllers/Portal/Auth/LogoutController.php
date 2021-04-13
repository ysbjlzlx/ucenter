<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $accessToken = $request->bearerToken();
        $this->tokenService->deleteToken($accessToken);

        return success();
    }
}
