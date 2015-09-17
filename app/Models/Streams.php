<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streams extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'streams';

    protected $fillable = array('stream_name', 'school_id');
}
