<?php

/*
 * Unauthenticated Group
 */
Route::group(array('before' => 'guest'), function() {
    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function() {
        /*
         *  User Sign-in (post)
         */
        Route::Post('/user/sign/in/post', array(
            'as' => 'user-sign-in-post',
            'uses' => 'UserLoginController@postSignIn'
        ));
        /*
         *  User Create Account (post)
         */
        Route::Post('/user/account', array(
            'as' => 'user-account-create-post',
            'uses' => 'UserLoginController@postCreate'
        ));
        /*
         *  User Sign-in (post)
         */
        Route::Post('/user/forgot/password/post', array(
            'as' => 'user-forgot-password-post',
            'uses' => 'UserAccountController@postForgotPassword'
        ));
    });
    /*
     * User Create Account (get)
     */
    Route::get('/user/account', array(
        'as' => 'user-account-create',
        'uses' => 'UserLoginController@getCreate'
    ));
    /*
     * User SignIn Account (get)
     */
    Route::get('/user/sign/in', array(
        'as' => 'user-sign-in',
        'uses' => 'UserLoginController@getSignIn'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/user/account/{userId}/activate/{code}', array(
        'as' => 'user-account-activate',
        'uses' => 'UserLoginController@getActivate'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/user/forgot/password', array(
        'as' => 'user-forgot-password',
        'uses' => 'UserAccountController@getForgotPassword'
    ));
    /*
     * User Recover Account (get)
     */
    Route::get('/user/account/recover/{code}', array(
        'as' => 'user-account-recover',
        'uses' => 'UserAccountController@getRecover'
    ));
    /*
     *  User Facebook Login
     */
    Route::get('/social/facebook/{auth?}',array(
        'as'=>'user-facebook-auth',
        'uses'=>'UserLoginController@getFacebookLogin'
    ));
    /*
     *  User Google Login
     */
    Route::get('/gauth/{auth?}',array(
        'as'=>'user-google-auth',
        'uses'=>'UserLoginController@getGoogleLogin'
    ));
});

/*
 * Authenticated Group
 */
Route::group(array('before' => 'UserAuth'), function() {

    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function() {

        /*
         *  Edit User Details (post)
         */
        Route::Post('/user/edit', array(
            'as' => 'user-edit-post',
            'uses' => 'UserAccountController@postEdit'
        ));
        /*
         *  Change User login Details (post)
         */
        Route::Post('/user/login/details', array(
            'as' => 'user-login-details-post',
            'uses' => 'UserAccountController@postChangePassword'
        ));

        /*
         * Class set Intial Settings (Post)
         */
        Route::Post('/user/class/set/intial', array(
            'as' => 'user-class-set-initial-post',
            'uses' => 'UserClassController@postSetInitial'
        ));
    });
    /*
     * non - protection Routes
     *
     * SignOUt (get)
     */
    Route::get('/user/sign/out', array(
        'as' => 'user-sign-out',
        'uses' => 'UserLoginController@getSignOut'
    ));

    /*
     * User Welcome Settings (get)
     */
    Route::get('/user/welcome/settings', array(
        'as' => 'user-welcome-settings',
        'uses' => 'UserLoginController@getWelcomeSettings'
    ));

    /*
     * User Home (get)
     */
    Route::get('/user/home', array(
        'as' => 'user-home',
        'uses' => 'UserLoginController@getUserHome'
    ));

    /*
     * User Profile (get)
     */
    Route::get('/user/profile', array(
        'as' => 'user-profile',
        'uses' => 'UserAccountController@getUserProfile'
    ));

    /*
     * Class set Intial Settings (get)
     */
    Route::get('/user/class/set/intial', array(
        'as' => 'user-class-set-initial',
        'uses' => 'UserLoginController@getSetInitial'
    ));

    /*
     * Other Class Users (get)
     */
    Route::get('/user/class/students', array(
        'as' => 'user-class-students',
        'uses' => 'UserClassController@getUsers'
    ));

    /*
     * Class schedule (get)
     */
    Route::get('/user/class/schedule', array(
        'as' => 'user-class-schedule',
        'uses' => 'UserClassController@getSchedule'
    ));

    /*
     * Class schedule Periods (get)
     */
    Route::Post('/user/class/schedule/periods', array(
        'as' => 'user-class-schedule-periods',
        'uses' => 'UserClassController@postClassTimeTable'
    ));

    /*
     * Class schedule Periods (get)
     */
    Route::get('/user/class/weekely/schedule', array(
        'as' => 'user-class-weekely-schedule',
        'uses' => 'UserClassController@getWeekelySchedule'
    ));
    /*
     * User Schedule Settings
     */
    /*
     * TimeTable per day
     */
    Route::get('/user/schedule/per/day', array(
        'as' => 'user-schedule-per-day',
        'uses' => 'UserScheduleController@getTimeTablePerDay'
    ));
    /*
     * User Attendance Settings
     */
    Route::get('/user/attendance', array(
        'as' => 'user-attendance',
        'uses' => 'UserClassController@getAttendance'
    ));
    /*
     * User Inbox 
     */
    Route::get('/user/inbox', array(
        'as' => 'user-inbox',
        'uses' => 'UserClassController@getInbox'
    ));
    /*
     * User Inbox 
     */
    Route::get('/user/inbox', array(
        'as' => 'user-inbox',
        'uses' => 'UserClassController@getInbox'
    ));
    /*
     * User Assignments 
     */
    Route::get('/user/assignments', array(
        'as' => 'user-assignments',
        'uses' => 'UserClassController@getAssignments'
    ));
    /*
     * School Events
     */
    Route::get('/user/events', array(
        'as' => 'user-events',
        'uses' => 'UserClassController@getEvents'
    ));
    /**
     * Ajax Api's
     */
    /**
     * APi for Attendance
     */
    Route::Post('/user/attendance/new/application/leave', array(
        'as' => 'user-attendance-new-attendance-leave',
        'uses' => 'UserClassController@postNewLeaveApplication'
    ));
    /*
     * Api to get All the Classes to a Stream  (post)
     */
    Route::Post('/user/classes/from/stream/id', array(
        'as' => 'user-get-classes-from-stream-id',
        'uses' => 'UserClassController@postGetClassesFromStreamId'
    ));
    /*
     * Api to get section by Class   (post)
     */
    Route::Post('user/get/sections/from/class/id', array(
        'as' => 'user-get-sections-from-class-id',
        'uses' => 'UserClassController@postGetSections'
    ));


});
