<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAccountController extends Controller
{

    public function getHome()
    {
        return view('user.home');
    }

    public function getWelcomeSettings()
    {
        return view('user.welcome-settings');
    }
}
