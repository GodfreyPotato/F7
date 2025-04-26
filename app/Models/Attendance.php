<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'status',
        'undertime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
