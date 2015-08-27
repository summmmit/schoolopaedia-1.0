<?php


Route::group(['before' => 'guest'], function(){
    /*
     * Thankyou page after registering (get)
     */
    Route::get('/account/thankyou/for/registering', array(
        'as' => 'account-thankyou-for-registering',
        'uses' => 'ErrorsAndThankYouController@getThankYouForRegistering'
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