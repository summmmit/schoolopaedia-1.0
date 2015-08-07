<?php
/*
 * Unauthenticated Group
 */
Route::group(array('prefix' => 'teacher', 'before' => 'guest'), function() {
    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function() {
        /*
         *  Teacher Account Create (post)
         */
        Route::Post('/account/create/post', array(
            'as' => 'teacher-account-create-post',
            'uses' => 'TeacherLoginController@postCreate'
        ));
        /*
         *  User Sign-in (post)
         */
        Route::Post('/sign/in/post', array(
            'as' => 'teacher-sign-in-post',
            'uses' => 'TeacherLoginController@postSignIn'
        ));
    });
    /*
     * Teacher Create Account (get)
     */
    Route::get('/account/create', array(
        'as' => 'teacher-account-create',
        'uses' => 'TeacherLoginController@getCreate'
    ));
    /*
     * Teacher Sign In (get)
     */
    Route::get('/sign/in', array(
        'as' => 'teacher-sign-in',
        'uses' => 'TeacherLoginController@getSignIn'
    ));    
    /*
     * Teacher Activate Account (get)
     */
    Route::get('/{userid}/activate/{code}', array(
        'as' => 'teacher-account-activate',
        'uses' => 'TeacherLoginController@getActivate'
    ));
    /*
     * Teacher Forgot password (get)
     */
    Route::get('/forgot/password', array(
        'as' => 'teacher-forgot-password',
        'uses' => 'TeacherLoginController@getForgotPassword'
    ));
    /*
     * Teacher Recover Account (get)
     */
    Route::get('/reset/password', array(
        'as' => 'teacher-reset-password',
        'uses' => 'TeacherLoginController@getResetPassword'
    ));
});
/*
 * Authenticated Group
 */
Route::group(array('prefix' => 'teacher', 'before' => 'teacherAuth'), function() {
    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function() {
        /*
         *  Edit User Details (post)
         */
        Route::Post('/teacher/edit', array(
            'as' => 'teacher-edit-post',
            'uses' => 'UserAccountController@postEdit'
        ));
    });
    /*
     *
     * SignOUt (get)
     */
    Route::get('/sign/out', array(
        'as' => 'teacher-sign-out',
        'uses' => 'TeacherLoginController@getSignOut'
    ));
    /*
     * User Welcome Settings (get)
     */
    Route::get('/welcome/settings', array(
        'as' => 'teacher-welcome-settings',
        'uses' => 'TeacherLoginController@getWelcomeSettings'
    ));
    /*
     * Admin Home (get)
     */
    Route::get('/home', array(
        'as' => 'teacher-home',
        'uses' => 'TeacherLoginController@getTeacherHome'
    ));
    /*
     * Admin Profile (get)
     */
    Route::get('/profile', array(
        'as' => 'teacher-profile',
        'uses' => 'TeacherAccountController@getTeacherProfile'
    ));
    /*
     * Teacher Attendance (get)
     */
    Route::get('/teacher/attendance', array(
        'as' => 'teacher-attendance',
        'uses' => 'TeacherController@getAttendance'
    ));
    /*
     * School All settings (get)
     */
    /*
     * Set Initial School Session
     */
    Route::get('/school/set/sessions', array(
        'as' => 'teacher-school-set-sessions',
        'uses' => 'TeacherLoginController@getSchoolSessions'
    ));
    /*
     * Set Initial School Session (post)
     */
    Route::Post('/school/set/sessions/post', array(
        'as' => 'teacher-school-set-sessions-post',
        'uses' => 'TeacherLoginController@postSetSchoolSessions'
    ));
});
