<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //

    public function form7()
    {
        return $this->belongsTo(Form7::class);
    }

  
}
