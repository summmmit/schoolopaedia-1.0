<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorsAndThankYouController extends Controller
{
    public function getThankYouForRegistering()
    {
        return view('schools.errorsAndThankYou.thankyou-registering');
    }

    public function getEmail()
    {
        return view('schools.emails.activate-school');
    }
}
