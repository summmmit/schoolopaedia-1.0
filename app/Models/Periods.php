<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Periods extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'periods';

    protected $fillable = array('period_name', 'start_time', 'end_time', 'period_profile_id');

    public function setPeriodNameAttribute($period_name){
        $this->attributes['period_name'] = ucwords($period_name);
    }
}
