<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekDays extends Model
{
    Const MONDAY = 1;

    Const TUESDAY = 2;

    Const WEDNESDAY = 3;

    Const THURSDAY = 4;

    Const FRIDAY = 5;

    Const SATURDAY = 6;

    Const SUNDAY = 7;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'week_days';

    protected $fillable = array('day');

    /**
     * Accessor for day
     * @param $day
     * @return string with first letter capital
     */
    public function getDayAttribute($day){

        return ucwords($day);
    }
}
