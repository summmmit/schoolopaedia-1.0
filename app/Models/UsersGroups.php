<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersGroups extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_groups';

    public $timestamps = false;

    protected $fillable = array('user_id', 'groups_id');

}
