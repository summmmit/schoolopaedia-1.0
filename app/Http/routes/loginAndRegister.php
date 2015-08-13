<?php


Route::group(array('before' => 'guest'), function () {
    /*
     * User Create Account (get)
     */
    Route::get('/account/user/create', array(
        'as' => 'account-create',
        'uses' => 'LoginAndRegisterController@getCreate'
    ));
    /*
     *  User Create Account (post)
     */
    Route::Post('/account/user/create', array(
        'as' => 'account-user-create-post',
        'uses' => 'LoginAndRegisterController@postCreate'
    ));
});