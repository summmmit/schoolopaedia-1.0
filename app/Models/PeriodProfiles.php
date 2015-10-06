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

    public function setProfileNameAttribute($profile_name){
        $this->attributes['profile_name'] = ucwords($profile_name);
    }
}
