<?php

namespace App\Http\Middleware;

use App\Http\Services\TokenService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TokenAuthenticate
{
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        $rules = [
            'access_token' => 'required|string',
        ];
        Validator::validate(['access_token' => $bearerToken], $rules);

        $token = $this->tokenService->getToken($bearerToken);
        if (empty($token)) {
            throw ValidationException::withMessages(['access_token' => 'access_token in invalid.']);
        }
        Auth::login($token->user);

        return $next($request);
    }
}
