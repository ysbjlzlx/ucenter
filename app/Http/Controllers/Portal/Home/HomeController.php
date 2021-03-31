<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;

class HomeConttroller extends Controller
{
    public function home()
    {
        return view('portal.profile.home');
    }
}
