<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailsToUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mails_to_user';

    function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }
}
