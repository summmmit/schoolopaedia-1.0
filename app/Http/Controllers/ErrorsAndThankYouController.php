<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorsAndThankYouController extends Controller
{
    public function getThankyou()
    {
        return view('layouts.thankyou.thankyou');
    }

    public function getEmail()
    {
        return view('schools.emails.activate-school');
    }
}
