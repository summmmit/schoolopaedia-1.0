<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Groups;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UsersLoginInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponseClass;
use App\Libraries\RequiredFunctions;
use App\Libraries\SchoolAndUserBasicInfo;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use Auth;

class AdminAccountController extends Controller
{
    /**
     * AdminAccountController constructor.
     */
    public function __construct()
    {

    }

    public function getSignIn()
    {
        return view('admin.account.login');
    }

    public function getCreate()
    {
        return view('admin.account.register');
    }

    public function getRetrievePassword()
    {
        return view('admin.account.forgot-password');
    }

    public function getHome()
    {
        return view('admin.home');
    }

    public function getWelcomeSettings()
    {
        return view('admin.welcome-settings');
    }
}
