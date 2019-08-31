<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function sender() 
    {
        return $this->belongsToMany(User::class, 'user_message', 'sender_id', 'message_id')->withTimestamps();
    }

    public function receiver() 
    {
        return $this->belongsToMany(User::class, 'user_message', 'message_id', 'receiver_id')->withTimestamps();
    }
}
