<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $employee = Auth::user();
        $attendanceRecords = AttendanceLog::where('user_id', $employee->id)->get();
        return view('employee.dashboard', compact('attendanceRecords'));
    }
    
    public function checkIn()
    {
        // Logic for employee check-in
    }

    public function checkOut()
    {
        // Logic for employee check-out
    }


}
