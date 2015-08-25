<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolSession extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_session';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'session_start',
        'session_end',
        'school_id',
        'current_session'
    );

}
