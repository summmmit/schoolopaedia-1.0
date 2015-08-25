<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schools extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'school_name',
        'manager_full_name',
        'phone_number',
        'email',
        'add_1',
        'add_2',
        'city',
        'state',
        'country',
        'pin_code',
        'registration_code',
        'code_for_admin',
        'code_for_moderators',
        'code_for_teachers',
        'code_for_parents',
        'code_for_students',
        'registration_date',
        'logo',
        'active',
    );
}
