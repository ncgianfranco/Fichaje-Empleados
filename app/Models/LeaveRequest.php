<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    //
    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at'
    ];

    // In LeaveRequest.php model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
