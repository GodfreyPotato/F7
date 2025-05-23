<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'firstname',
        'lastname',
        'department',
        'email',
        'password',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
}
