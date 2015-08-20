<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAccountController extends Controller
{
    /**
     * TO show form for user Login
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        return view('user.home');
    }
}
