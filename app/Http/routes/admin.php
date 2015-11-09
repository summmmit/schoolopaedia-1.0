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
     * Validate Admin By school code and admin code
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
     * Admin School Settings Page (get)
     */
    Route::get('/school/settings', array(
        'as' => 'admin-school-settings',
        'uses' => 'Admin\AdminSchoolSettingsController@getSchoolSettings'
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
     * Get School Schedule (post)
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
    /*
     * Get School Schedules By Profile (post)
     */
    Route::Post('/school/get/schedule/by/profile/post', array(
        'as' => 'admin-school-get-schedule-by-profile-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetAllSchedulesFromProfile'
    ));
    /*
     * School Information
     */
    Route::Post('/school/information/post', array(
        'as' => 'admin-school-information-post',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetSchoolInformation'
    ));
    /*
     * School Sessions
     */
    Route::get('/school/sessions', array(
        'as' => 'admin-school-sessions',
        'uses' => 'Admin\AdminSchoolSettingsController@getSchoolSessions'
    ));
    /**
     * Get All School Students
     */
    Route::get('/school/students', array(
        'as' => 'admin-school-students',
        'uses' => 'Admin\AdminSchoolSettingsController@getSchoolStudents'
    ));
    /**
     * Get School Streams And Classes settings
     */
    Route::get('/school/class/settings', array(
        'as' => 'admin-class-settings',
        'uses' => 'Admin\AdminClassSettingsController@getClassesSettings'
    ));
    /**
     * Get All School Streams
     */
    Route::Post('/get/all/streams', array(
        'as' => 'admin-get-all-streams',
        'uses' => 'Admin\AdminClassSettingsController@postAllStreams'
    ));
    /**
     * Add or Edit a Stream
     */
    Route::Post('/add/or/edit/stream', array(
        'as' => 'admin-add-edit-stream',
        'uses' => 'Admin\AdminClassSettingsController@postAddOrEditStream'
    ));
    /**
     * Delete a Stream
     */
    Route::Post('/delete/stream', array(
        'as' => 'admin-delete-stream',
        'uses' => 'Admin\AdminClassSettingsController@postDeleteStream'
    ));
    /**
     * Get All Class By Stream Id
     */
    Route::Post('/get/all/classes/by/stream/id', array(
        'as' => 'admin-get-all-classes-by-stream-id',
        'uses' => 'Admin\AdminClassSettingsController@postGetAllClassesByStreamId'
    ));
    /**
     * Add or Edit a Class
     */
    Route::Post('/add/or/edit/class', array(
        'as' => 'admin-add-edit-class',
        'uses' => 'Admin\AdminClassSettingsController@postAddOrEditClass'
    ));
    /**
     * Delete a Stream
     */
    Route::Post('/delete/class', array(
        'as' => 'admin-delete-class',
        'uses' => 'Admin\AdminClassSettingsController@postDeleteClass'
    ));
    /**
     * Get All Sections By Class Id
     */
    Route::Post('/get/all/sections/by/class/id', array(
        'as' => 'admin-get-all-sections-by-class-id',
        'uses' => 'Admin\AdminClassSettingsController@postGetAllSectionsByClassId'
    ));
    /**
     * Add or Edit a Section
     */
    Route::Post('/add/or/edit/section', array(
        'as' => 'admin-add-edit-section',
        'uses' => 'Admin\AdminClassSettingsController@postAddOrEditSection'
    ));
    /**
     * Delete a Section
     */
    Route::Post('/delete/section', array(
        'as' => 'admin-delete-section',
        'uses' => 'Admin\AdminClassSettingsController@postDeleteSection'
    ));
    /**
     * Get All Subjects By Section Id
     */
    Route::Post('/get/all/subjects/by/section/id', array(
        'as' => 'admin-get-all-subjects-by-section-id',
        'uses' => 'Admin\AdminClassSettingsController@postGetAllSubjectsBySectionId'
    ));
    /**
     * Add or Edit a Subject
     */
    Route::Post('/add/or/edit/subject', array(
        'as' => 'admin-add-edit-subject',
        'uses' => 'Admin\AdminClassSettingsController@postAddOrEditSubject'
    ));
    /**
     * Delete a Subject
     */
    Route::Post('/delete/subject', array(
        'as' => 'admin-delete-subject',
        'uses' => 'Admin\AdminClassSettingsController@postDeleteSubject'
    ));
    /**
     * Get All School Sessions
     */
    Route::Post('/get/all/sessions/post', array(
        'as' => 'admin-get-all-sessions',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetAllSessions'
    ));
    /**
     * Get School Session By Session By
     */
    Route::Post('/get/session/by/id', array(
        'as' => 'admin-get-session',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetSessionBySessionId'
    ));
    /**
     * Create Or Edit School Session
     */
    Route::Post('/create/or/edit/session/post', array(
        'as' => 'admin-create-or-edit-session',
        'uses' => 'Admin\AdminSchoolSettingsController@postAddOrEditSession'
    ));
    /**
     * Delete a Session
     */
    Route::Post('/delete/session', array(
        'as' => 'admin-delete-session',
        'uses' => 'Admin\AdminSchoolSettingsController@postDeleteSession'
    ));
    /**
     * Make Session Current
     */
    Route::Post('/make/session/current', array(
        'as' => 'admin-session-current',
        'uses' => 'Admin\AdminSchoolSettingsController@postMakeSessionCurrent'
    ));
    /**
     * Get Current Session
     */
    Route::Post('/get/current/session', array(
        'as' => 'admin-current-session',
        'uses' => 'Admin\AdminSchoolSettingsController@postGetSchoolCurrentSession'
    ));
    /**
     * Check if Current Session is set
     */
    Route::Post('/check/current/session/is/set', array(
        'as' => 'admin-check-current-session-set',
        'uses' => 'Admin\AdminSchoolSettingsController@checkIfCurrentSessionSet'
    ));
    /**
     * Get All School Teachers (get)
     */
    Route::get('/school/teachers', array(
        'as' => 'admin-school-teachers',
        'uses' => 'Admin\AdminTeacherSettingsController@getSchoolTeachers'
    ));
    /**
     * Get All the Teachers (Post)
     */
    Route::Post('/get/all/teachers', array(
        'as' => 'admin-all-teachers',
        'uses' => 'Admin\AdminTeacherSettingsController@postGetAllTheTeachersRegisteredToSchool'
    ));
    /**
     * Get All School Students (get)
     */
    Route::get('/school/students', array(
        'as' => 'admin-school-students',
        'uses' => 'Admin\AdminStudentSettingsController@getSchoolStudents'
    ));
    /**
     * Get All the Students (Post)
     */
    Route::Post('/get/all/students', array(
        'as' => 'admin-all-students',
        'uses' => 'Admin\AdminStudentSettingsController@postGetAllTheStudentsRegisteredToSchool'
    ));
    /**
     * Get School Time Table (get)
     */
    Route::get('/school/time/table', array(
        'as' => 'admin-school-time-table',
        'uses' => 'Admin\AdminTimeTableController@getTimeTable'
    ));
    /**
     * Get Admin Profile (get)
     */
    Route::get('/profile', array(
        'as' => 'admin-profile',
        'uses' => 'Admin\AdminAccountController@getProfile'
    ));

    //*******************************************Inbox *****************************************************************

    /**
     * Get Admin Inbox (get)
     */
    Route::get('/inbox', array(
        'as' => 'admin-inbox',
        'uses' => 'Admin\AdminInboxController@getInbox'
    ));
    /**
     * Get All the Inbox Mails (Post)
     */
    Route::Post('/get/all/inbox/mails', array(
        'as' => 'admin-all-inbox-mails',
        'uses' => 'InboxController@postGetAllInboxMails'
    ));
    /**
     * Compose Email (Post)
     */
    Route::Post('/compose/mail', array(
        'as' => 'admin-compose-mail',
        'uses' => 'InboxController@postComposeMail'
    ));
    /**
     * Get Inbox Folders (Post)
     */
    Route::Post('/get/inbox/folders', array(
        'as' => 'admin-compose-mail',
        'uses' => 'InboxController@postGetAllInboxFolders'
    ));
});