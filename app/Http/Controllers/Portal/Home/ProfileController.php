<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $data = [
            'user' => $request->user(),
        ];

        return view('portal.home.profile', $data);
    }
}
