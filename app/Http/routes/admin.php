<?php


Route::group(['prefix' => 'admin', 'before' => 'guest'], function () {
    /*
     * Admin Create Account (get)
     */
    Route::get('/account/create', array(
        'as' => 'account-admin-create',
        'uses' => 'Admin\AdminAccountController@getCreate'
    ));
    /*
     *  Admin Create Account (post)
     */
    Route::Post('/account/create/post', array(
        'as' => 'account-admin-create-post',
        'uses' => 'LoginAndRegisterController@postCreate'
    ));
    /*
     * Admin SignIn Account (get)
     */
    Route::get('/account/sign/in', array(
        'as' => 'account-admin-sign-in',
        'uses' => 'Admin\AdminAccountController@getSignIn'
    ));
    /*
     * Admin SignIn Account (Post)
     */
    Route::Post('/account/sign/in', array(
        'as' => 'account-admin-sign-in-post',
        'uses' => 'LoginAndRegisterController@postSignIn'
    ));
    /*
     * Admin Forgot password (get)
     */
    Route::get('/account/retrieve/password', array(
        'as' => 'account-admin-retrieve-password',
        'uses' => 'Admin\AdminAccountController@getRetrievePassword'
    ));
    /*
     * Admin Forgot password (get)
     */
    Route::Post('/account/retrieve/password/post', array(
        'as' => 'account-admin-retrieve-password-post',
        'uses' => 'LoginAndRegisterController@postRetrievePassword'
    ));
    /*
     * Admin Activate Account (get)
     */
    Route::get('/account/{adminId}/activate/{code}', array(
        'as' => 'account-admin-activate',
        'uses' => 'LoginAndRegisterController@getActivate'
    ));
    /*
     * Admin Recover Account (get)
     */
    Route::get('/account/{adminId}/recover/{code}', array(
        'as' => 'account-admin-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * Admin Recover Account (get)
     */
    Route::post('/account/recover', array(
        'as' => 'account-admin-recover-post',
        'uses' => 'LoginAndRegisterController@postRecover'
    ));
    /*
     * Admin Log Out (get)
     */
    Route::get('/account/logout', array(
        'as' => 'account-admin-logout',
        'uses' => 'LoginAndRegisterController@getLogout'
    ));
    /*
     * Admin Recover Account (get)
     */
    Route::get('/account/recover/{code}', array(
        'as' => 'admin-account-recover',
        'uses' => 'LoginAndRegisterController@getRecover'
    ));
    /*
     * Admin Forgot password (get)
     */
    Route::get('/first/page/{adminId}', array(
        'as' => 'admin-first-page',
        'uses' => 'LoginAndRegisterController@goToAfterSignInAdmin'
    ));

});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    /*
     * Admin Welcome Settings (get)
     */
    Route::get('/welcome/settings', array(
        'as' => 'admin-welcome-settings',
        'uses' => 'Admin\AdminAccountController@getWelcomeSettings'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-admin-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
    /*
     * Admin HomePage (get)
     */
    Route::get('/home', array(
        'as' => 'admin-home',
        'uses' => 'Admin\AdminAccountController@getHome'
    ));
    /*
     * Class set Intial Settings (get)
     */
    Route::get('/class/set/intial', array(
        'as' => 'admin-class-set-initial',
        'uses' => 'Admin\AdminSchoolSettingsController@getSetInitial'
    ));
    /*
     * Class set Intial Settings (Post)
     */
    Route::Post('/class/set/intial', array(
        'as' => 'admin-class-set-initial-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postSetSchoolSessions'
    ));
    /*
     * Get All School Schedule Profiles (post)
     */
    Route::Post('/school/get/all/schedule/profile/post', array(
        'as' => 'admin-school-get-all-schedule-profile-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetAllSchoolScheduleProfile'
    ));
    /*
     * Set School Schedule Profile (post)
     */
    Route::Post('/school/set/schedule/profile/post', array(
        'as' => 'admin-school-set-schedule-profile-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postSetSchoolScheduleProfile'
    ));
    /*
     * Delete School Schedule Profile (post)
     */
    Route::Post('/school/delete/schedule/profile/post', array(
        'as' => 'admin-school-delete-schedule-profile-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postDeleteSchoolScheduleProfile'
    ));
    /*
     * Make School Schedule Profile - Current (post)
     */
    Route::Post('/school/make/current/schedule/profile/post', array(
        'as' => 'admin-school-make-current-schedule-profile-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postMakeSchoolScheduleProfileCurrent'
    ));
    /*
     * Set Initial School Schedule (post)
     */
    Route::get('/school/get/schedule', array(
        'as' => 'admin-school-get-schedule',
        'uses' => 'Admin\AdminSchoolSettingsController@getSchoolSchedule'
    ));
    /*
     * Set Initial School Schedule (post)
     */
    Route::Post('/school/set/schedule/post', array(
        'as' => 'admin-school-set-schedule-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postSetSchoolSchedule'
    ));
});