<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersRegisteredToSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_registered_to_session';

    protected $fillable = array('session_id', 'section_id', 'user_id');
}
