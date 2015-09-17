<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    protected $fillable = array('subject_name', 'subject_code', 'class_id', 'section_id');
}
