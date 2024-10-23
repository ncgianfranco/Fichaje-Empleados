<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendandeController extends Controller
{
    

    //método para fichar
    public function clockIn() {
        $user = Auth::user();
        AttendanceLog::create([
            'user_id' => $user->id,
            'clock_in_time' => now(),
        ]);
        return redirect()->back()->with('success', 'Clocked in successfully');
    }
    
    //método para desfichar
    public function clockOut() {
        $log = AttendanceLog::where('user_id', Auth::id())->latest()->first();
        $log->update(['clock_out_time' => now()]);
        return redirect()->back()->with('success', 'Clocked out successfully');
    }
    
}
