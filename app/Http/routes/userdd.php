<?php
/*
 * Unauthenticated Group
 */
Route::group(array('before' => 'guest'), function() {
    /*
     *  User Account Create By Mobile App (post)
     */
    Route::Post('/account/create/post', array(
        'as' => 'mobile-user-account-create-post',
        'uses' => 'MobileUserController@postCreate'
    ));
    /*
     * User Activate Account (get)
     */
    Route::get('/account/{userId}/activate/{code}', array(
        'as' => 'user-account-activate',
        'uses' => 'UserLoginController@getActivate'
    ));
    /*
     *  User Sign-in (post)SchoolController.php
     */
    Route::Post('/sign/in/post', array(
        'as' => 'user-sign-in-post',
        'uses' => 'MobileUserController@postSignIn'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-user-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));

});
