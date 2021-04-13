<?php

namespace App\Http\Controllers\Portal\Home;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function profilePage()
    {
        return Inertia::render('Home/Profile');
    }
}
