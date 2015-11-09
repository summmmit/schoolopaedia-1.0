<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailsToFolder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mails_to_folder';
    
    protected $fillable = array('mail_id', 'user_id', 'folder_id');

    public $timestamps = false;
}
