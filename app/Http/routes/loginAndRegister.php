<?php


Route::group(array('before' => 'guest'), function () {
    /*
     *  User Create Account (post)
     */
    Route::Post('/account/user/create', array(
        'as' => 'account-user-create-post',
        'uses' => 'UserLoginController@postCreate'
    ));
});