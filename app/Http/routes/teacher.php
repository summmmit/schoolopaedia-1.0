<?php


Route::group(['prefix' => 'teacher'], function(){
    /*
     * User Forgot password (get)
     */
    Route::get('/home', array(
        'as' => 'teacher-home',
        'uses' => 'User\UserAccountController@getHome'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/account/recover/{code}', array(
        'as' => 'teacher-account-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-teacher-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
    /*
     * User Welcome Settings (get)
     */
    Route::get('/welcome/settings', array(
        'as' => 'teacher-welcome-settings',
        'uses' => 'UserAccountController@getWelcomeSettings'
    ));

});