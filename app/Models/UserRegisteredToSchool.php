<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegisteredToSchool extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_registered_to_school';

    protected $dates = ['deleted_at'];

    protected $fillable = array('user_id', 'school_id', 'registration_date');
}
