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

require_once app_path().'/Http/routes/loginAndRegister.php';       // including the login and Register routes

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);
