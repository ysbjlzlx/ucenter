<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('portal.profile.home');
    }
}
