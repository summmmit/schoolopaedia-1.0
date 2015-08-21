<?php


Route::group(['prefix' => 'user'], function(){
    /*
     * User Forgot password (get)
     */
    Route::get('/home', array(
        'as' => 'user-home',
        'uses' => 'User\UserAccountController@getHome'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/{userId}/activate/{code}', array(
        'as' => 'user-account-activate',
        'uses' => 'UserLoginController@getActivate'
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