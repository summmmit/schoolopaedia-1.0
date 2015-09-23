<?php


Route::group(['prefix' => 'teacher'], function(){

    /*
     * Teacher Forgot password (get)
     */
    Route::get('/first/page/{teacherId}', array(
        'as' => 'teacher-first-page',
        'uses' => 'LoginAndRegisterController@goToAfterSignIn'
    ));
    /*
     * Teacher Forgot password (get)
     */
    Route::get('/home', array(
        'as' => 'teacher-home',
        'uses' => 'Teacher\TeacherAccountController@getHome'
    ));
    /*
     * Teacher Log Out (get)
     */
    Route::get('/account/logout', array(
        'as' => 'teacher-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
    /*
     * Teacher Welcome Settings (get)
     */
    Route::get('/welcome/settings', array(
        'as' => 'teacher-welcome-settings',
        'uses' => 'Teacher\TeacherAccountController@getWelcomeSettings'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-teacher-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
    /*
     * Class set Intial Settings (Post)
     */
    Route::Post('/class/set/intial/post', array(
        'as' => 'teacher-class-set-initial-post',
        'uses' => 'Teacher\TeacherAccountController@postSetInitial'
    ));
    /*
     * Class set Intial Settings (get)
     */
    Route::get('/class/set/intial', array(
        'as' => 'teacher-class-set-initial',
        'uses' => 'Teacher\TeacherAccountController@getSetInitial'
    ));
});