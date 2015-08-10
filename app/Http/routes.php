<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

require_once app_path().'/Http/routes/user.php';       // including the user routes

require_once app_path().'/Http/routes/admin.php';       // including the admin routes

require_once app_path().'/Http/routes/teacher.php';       // including the teacher routes

require_once app_path().'/Http/routes/school.php';       // including the school routes