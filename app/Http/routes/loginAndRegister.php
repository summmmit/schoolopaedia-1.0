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
    Route::get('/account/forgot/password', array(
        'as' => 'account-user-forgot-password',
        'uses' => 'LoginAndRegisterController@getForgotPassword'
    ));
    /*
     * User Log Out (get)
     */
    Route::get('/account/logout', array(
        'as' => 'account-user-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
});