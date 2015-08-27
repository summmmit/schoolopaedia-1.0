<?php


Route::group(array('before' => 'guest'), function () {
    /*
     * User Create Account (get)
     */
    Route::get('/account/user/create', array(
        'as' => 'account-user-create',
        'uses' => 'LoginAndRegisterController@getCreate'
    ));
    /*
     *  User Create Account (post)
     */
    Route::Post('/account/user/create/post', array(
        'as' => 'account-user-create-post',
        'uses' => 'LoginAndRegisterController@postCreate'
    ));
    /*
     * User SignIn Account (get)
     */
    Route::get('/account/user/sign/in', array(
        'as' => 'account-user-sign-in',
        'uses' => 'LoginAndRegisterController@getSignIn'
    ));
    /*
     * User SignIn Account (Post)
     */
    Route::Post('/account/user/sign/in', array(
        'as' => 'account-user-sign-in-post',
        'uses' => 'LoginAndRegisterController@postSignIn'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/account/user/retrieve/password', array(
        'as' => 'account-user-retrieve-password',
        'uses' => 'LoginAndRegisterController@getRetrievePassword'
    ));
    /*
     * User Forgot password (get)
     */
    Route::Post('/account/user/retrieve/password/post', array(
        'as' => 'account-user-retrieve-password-post',
        'uses' => 'LoginAndRegisterController@postRetrievePassword'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/user/{userId}/activate/{code}', array(
        'as' => 'account-user-activate',
        'uses' => 'LoginAndRegisterController@getActivate'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/user/{userId}/recover/{code}', array(
        'as' => 'account-user-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * User Recover Account (get)
     */
    Route::post('/account/user/recover', array(
        'as' => 'account-user-recover-post',
        'uses' => 'LoginAndRegisterController@postRecover'
    ));
    /*
     * User Log Out (get)
     */
    Route::get('/account/user/logout', array(
        'as' => 'account-user-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
});