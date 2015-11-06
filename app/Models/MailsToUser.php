<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailsToUser extends Model
{

    const MAIL_HAVE_READ = 1;
    const MAIL_UNREAD = 0;

    protected $fillable = array('mail_id', 'user_send_by', 'user_send_to', 'send_at', 'is_read');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mails_to_user';
}
