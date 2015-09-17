<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
     * The database table used by the model.     *
     * @var string
     */
    protected $table = 'classes';

    protected $fillable = array('class_name', 'stream_id', 'school_id');
}
