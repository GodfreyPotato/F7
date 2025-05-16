<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form7 extends Model
{
    //

    public function leaves(){
        return $this->hasMany(related: Leave::class);
    }
}
