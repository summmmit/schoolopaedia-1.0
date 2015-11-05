<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mails extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = array('subject', 'message');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mails';
}
