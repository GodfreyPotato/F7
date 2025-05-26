<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class);
    }
}
