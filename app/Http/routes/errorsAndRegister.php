<?php


Route::group(['prefix' => 'user'], function(){
    /*
     * User Forgot password (get)
     */
    Route::get('/account/thankyou', array(
        'as' => 'account-thankyou',
        'uses' => 'ErrorsAndThankYouController@getThankyou'
    ));
    /*
     * Validate Admin By school code and teacher code
     */
    Route::Post('/school/validation', array(
        'as' => 'mobile-user-school-validation-post',
        'uses' => 'SchoolController@postValidateSchool'
    ));
});