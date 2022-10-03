<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailBox extends Model
{
    protected $table = "mail_box";
    protected $fillable = [
        'user_id', 'name'
    ];
}
