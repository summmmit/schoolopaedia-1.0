<?php

/*
 * Unauthenticated Group
 */
Route::group(array('before' => 'guest'), function() {
    /*
     * School Create Account (get)
     */
    Route::get('/register', array(
        'as' => 'school-register',
        'uses' => 'SchoolController@getCreate'
    ));
    /*
     *  School Sign-in (post)
     */
    Route::Post('/register/post', array(
        'as' => 'school-register-post',
        'uses' => 'SchoolController@postCreate'
    ));
    /*
     * School Activate Account (get)
     */
    Route::get('/activate/school/{code}', array(
        'as' => 'school-account-activate',
        'uses' => 'ErrorsAndThankYouController@getThankyou'
    ));
    /**
     * Ajax Api
     */
    /*
     * Get Current School Session
     */
    Route::Post('/school/current/session', array(
        'as' => 'school-current-session',
        'uses' => 'SchoolController@postGetSchoolCurrentSession'
    ));
    /*
     * Validate User By school code and student code
     */
    Route::Post('/school/student/validation', array(
        'as' => 'student-validation-post',
        'uses' => 'SchoolController@postValidateSchoolForStudents'
    ));
    /*
     * Validate Admin By school code and admin code
     */
    Route::Post('/school/admin/validation', array(
        'as' => 'admin-validation-post',
        'uses' => 'SchoolController@postValidateSchoolForAdmin'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
    /*
     * Briefly Update the details of the user
     */
    Route::Post('/school/brief/update', array(
        'as' => 'school-brief-update-post',
        'uses' => 'SchoolController@postBriefRegistration'
    ));
});
