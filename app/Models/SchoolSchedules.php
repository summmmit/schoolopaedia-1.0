<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSchedules extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_schedules';

    protected $fillable = array(
        'start_from',
        'close_untill',
        'opening_time',
        'lunch_time',
        'closing_time',
        'school_id',
        'school_session_id',
        'school_schedule_profile_id'
    );
}
