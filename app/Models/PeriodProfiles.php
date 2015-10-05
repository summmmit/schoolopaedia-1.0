<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodProfiles extends Model
{
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'period_profiles';

    protected $fillable = array('profile_name', 'school_id', 'current_profile');
}
