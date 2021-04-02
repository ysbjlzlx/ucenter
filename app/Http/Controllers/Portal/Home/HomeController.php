<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return redirect()->route('home.profile');
    }
}
