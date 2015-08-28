<?php


Route::group([ 'before' => 'guest', 'prefix' => 'user' ], function () {
    /*
     * User Create Account (get)
     */
    Route::get('/account/create', array(
        'as' => 'account-user-create',
        'uses' => 'LoginAndRegisterController@getCreate'
    ));
    /*
     *  User Create Account (post)
     */
    Route::Post('/account/create/post', array(
        'as' => 'account-user-create-post',
        'uses' => 'LoginAndRegisterController@postCreate'
    ));
    /*
     * User SignIn Account (get)
     */
    Route::get('/account/sign/in', array(
        'as' => 'account-user-sign-in',
        'uses' => 'LoginAndRegisterController@getSignIn'
    ));
    /*
     * User SignIn Account (Post)
     */
    Route::Post('/account/sign/in', array(
        'as' => 'account-user-sign-in-post',
        'uses' => 'LoginAndRegisterController@postSignIn'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/account/retrieve/password', array(
        'as' => 'account-user-retrieve-password',
        'uses' => 'LoginAndRegisterController@getRetrievePassword'
    ));
    /*
     * User Forgot password (get)
     */
    Route::Post('/account/retrieve/password/post', array(
        'as' => 'account-user-retrieve-password-post',
        'uses' => 'LoginAndRegisterController@postRetrievePassword'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/{userId}/activate/{code}', array(
        'as' => 'account-user-activate',
        'uses' => 'LoginAndRegisterController@getActivate'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/{userId}/recover/{code}', array(
        'as' => 'account-user-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * User Recover Account (get)
     */
    Route::post('/account/recover', array(
        'as' => 'account-user-recover-post',
        'uses' => 'LoginAndRegisterController@postRecover'
    ));
    /*
     * User Log Out (get)
     */
    Route::get('/account/logout', array(
        'as' => 'account-user-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
});