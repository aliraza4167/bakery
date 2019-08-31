<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    
    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }
}
