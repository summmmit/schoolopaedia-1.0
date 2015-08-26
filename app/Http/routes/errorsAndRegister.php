<?php


Route::group(['before' => 'guest'], function(){
    /*
     * Thankyou page after registering (get)
     */
    Route::get('/account/thankyou', array(
        'as' => 'account-thankyou',
        'uses' => 'ErrorsAndThankYouController@getThankyou'
    ));
    /*
     * User Forgot password (get)
     */
    Route::get('/account/email', array(
        'as' => 'account-email',
        'uses' => 'ErrorsAndThankYouController@getEmail'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-user-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
});