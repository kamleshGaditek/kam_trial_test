<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $fillable = [
        'mail_box_id', 'sender_id', 'receiver_email', 'subject', 'message'
    ];

    public function sender(){
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
