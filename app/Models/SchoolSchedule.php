<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSchedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_schedule';

    protected $fillable = array(
        'start_from',
        'close_untill',
        'opening_time',
        'lunch_time',
        'closing_time',
        'school_id',
        'school_session_id'
    );
}
