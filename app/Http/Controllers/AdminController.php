<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('role', 'employee')->get(); // Fetch all employees
        $attendanceRecords = AttendanceLog::all(); // Fetch all attendance records
        return view('admin.dashboard', compact('employees', 'attendanceRecords'));
    }

}
