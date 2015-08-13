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
    public function getSignIn()
    {
        return view('user.account.login');
    }
    /**
     * To show form for User Registration
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('user.account.register');
    }
}
