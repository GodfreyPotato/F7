<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    //  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leave()
    {
        return $this->hasOne(Leave::class);
    }
}
