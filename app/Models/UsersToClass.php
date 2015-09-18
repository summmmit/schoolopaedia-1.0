<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersToClass extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_to_class';

    protected $fillable = array('session_id', 'stream_id', 'section_id', 'class_id', 'user_id');
}
