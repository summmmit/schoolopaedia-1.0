<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLoginInfo extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_login_info';

    protected $fillable = array(
        'user_id',
        'school_id',
        'ip',
        'latitude',
        'longitude',
        'area_code',
        'time_zone',
        'country',
        'isp',
        'session_length'
    );

    protected $dates = ['deleted_at'];

}
