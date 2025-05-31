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

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
