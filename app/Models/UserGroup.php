<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_group';

    public $timestamps = false;

    protected $fillable = array('user_id', 'group_id');

}
