<?php

Route::group(['prefix' => 'user'], function(){
    /*
     * User Create Account (get)
     */
    Route::get('/account/create', array(
        'as' => 'user-account-create',
        'uses' => 'LoginAndRegisterController@getCreate'
    ));
    /*
     *  User Account Create (post)
     */
    Route::Post('/account/create/post', array(
        'as' => 'user-account-create-post',
        'uses' => 'MobileUserController@postCreate'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/{userId}/activate/{code}', array(
        'as' => 'user-account-activate',
        'uses' => 'UserLoginController@getActivate'
    ));
    /*
     * User SignIn Account (get)
     */
    Route::get('/sign/in', array(
        'as' => 'user-sign-in',
        'uses' => 'LoginAndRegisterController@getSignIn'
    ));
    /*
     *  User Sign-in (post)SchoolController.php
     */
    Route::Post('/sign/in/post', array(
        'as' => 'user-sign-in-post',
        'uses' => 'LoginAndRegisterController@postSignIn'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/forgot/password', array(
        'as' => 'user-forgot-password',
        'uses' => 'LoginAndRegisterController@getForgotPassword'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/recover/{code}', array(
        'as' => 'user-account-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-user-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));

});