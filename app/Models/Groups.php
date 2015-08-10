<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    const Administrator_Group_ID = 1;
    const Student_Group_Id = 2;
    const Teacher_Group_Id = 3;

    protected $fillable = array('name', 'permissions');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';
}