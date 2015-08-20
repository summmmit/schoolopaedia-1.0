<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserDetails extends Model {

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'username',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'sex',
        'marriage_status',
        'mobile_number',
        'mobile_updated_at',
        'mobile_verified',
        'home_number',
        'add_1',
        'add_2',
        'city',
        'state',
        'country',
        'pin_code',
        'address_updated_at',
        'pic',
        'pic_updated_at',
        'skype',
        'facebook',
        'google_plus',
        'twitter',
        'user_id'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_details';

}
