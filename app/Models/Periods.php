<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periods extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'periods';

    protected $fillable = array('period_name', 'start_time', 'end_time', 'period_profile_id');
}
