<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserLocation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products() 
    {
        return $this->hasMany(Product::class);
    }

    public function userLocations()
    {
        return $this->hasMany(UserLocation::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Messages::class, 'user_message', 'sender_id', 'message_id')->withTimestamps();
    }

    public function receivedMessages()
    {
        return $this->belongsToMany(Messages::class, 'user_message', 'receiver_id', 'message_id')->withTimestamps();
    }


}
