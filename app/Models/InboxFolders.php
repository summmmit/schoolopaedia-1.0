<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\SchoolAndUserBasicInfo;

class InboxFolders extends Model
{

    const FOLDER_INBOX = 'Inbox';
    const FOLDER_INBOX_ID = 1;

    const FOLDER_SENT_MAILS = 'Sent Mails';
    const FOLDER_SENT_MAILS_ID = 2;

    const FOLDER_IMPORTANT = 'Important';
    const FOLDER_IMPORTANT_ID = 3;

    const FOLDER_TRASH = 'Trash';
    const FOLDER_TRASH_ID = 4;

    const USER_MADE_FOLDER = 9;

    protected $fillable = array('user_id', 'folder_name', 'folder_id');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inbox_folders';
}
