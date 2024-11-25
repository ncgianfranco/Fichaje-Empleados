<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    //
    protected $fillable = [
        'user_id',
 
    ];
    protected $casts = [
        'clock_in_time' => 'datetime',
        'clock_out_time' => 'datetime',
    ];

    // In AttendanceLog.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }


}
