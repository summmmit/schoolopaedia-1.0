<?php


Route::group(['prefix' => 'admin'], function () {
    /*
     * User Create Account (get)
     */
    Route::get('/account/create', array(
        'as' => 'account-admin-create',
        'uses' => 'Admin\AdminAccountController@getCreate'
    ));
    /*
     *  User Create Account (post)
     */
    Route::Post('/account/create/post', array(
        'as' => 'account-admin-create-post',
        'uses' => 'LoginAndRegisterController@postCreate'
    ));
    /*
     * User SignIn Account (get)
     */
    Route::get('/account/sign/in', array(
        'as' => 'account-admin-sign-in',
        'uses' => 'Admin\AdminAccountController@getSignIn'
    ));
    /*
     * User SignIn Account (Post)
     */
    Route::Post('/account/sign/in', array(
        'as' => 'account-admin-sign-in-post',
        'uses' => 'LoginAndRegisterController@postSignIn'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/account/retrieve/password', array(
        'as' => 'account-admin-retrieve-password',
        'uses' => 'Admin\AdminAccountController@getRetrievePassword'
    ));
    /*
     * User Forgot password (get)
     */
    Route::Post('/account/retrieve/password/post', array(
        'as' => 'account-admin-retrieve-password-post',
        'uses' => 'LoginAndRegisterController@postRetrievePassword'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/{adminId}/activate/{code}', array(
        'as' => 'account-admin-activate',
        'uses' => 'LoginAndRegisterController@getActivate'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/{adminId}/recover/{code}', array(
        'as' => 'account-admin-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * User Recover Account (get)
     */
    Route::post('/account/recover', array(
        'as' => 'account-admin-recover-post',
        'uses' => 'LoginAndRegisterController@postRecover'
    ));
    /*
     * User Log Out (get)
     */
    Route::get('/account/logout', array(
        'as' => 'account-admin-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/recover/{code}', array(
        'as' => 'admin-account-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-admin-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/first/page/{adminId}', array(
        'as' => 'admin-first-page',
        'uses' => 'LoginAndRegisterController@goToAfterSignIn'
    ));
    /*
     * Admin HomePage (get)
     */
    Route::get('/home', array(
        'as' => 'admin-home',
        'uses' => 'Admin\AdminAccountController@getHome'
    ));
    /*
     * User Welcome Settings (get)
     */
    Route::get('/welcome/settings', array(
        'as' => 'admin-welcome-settings',
        'uses' => 'Admin\AdminAccountController@getWelcomeSettings'
    ));
    /*
     * Class set Intial Settings (get)
     */
    Route::get('/class/set/intial', array(
        'as' => 'admin-class-set-initial',
        'uses' => 'Admin\AdminAccountController@getSetInitial'
    ));
    /*
     * Class set Intial Settings (Post)
     */
    Route::Post('/account/class/set/intial', array(
        'as' => 'admin-class-set-initial-post',
        'uses' => 'Admin\AdminAccountController@postSetInitial'
    ));

});