<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    //
    protected $fillable = [
        'user_id',
 
    ];

    // In AttendanceLog.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }


}
