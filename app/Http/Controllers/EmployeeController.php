<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\LeaveRequest;
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
        $attendance = new AttendanceLog();
        $attendance->user_id = Auth::id();
        $attendance->clock_in_time = now();
        $attendance->save();

        return redirect()->route('employee.dashboard')->with('success', 'Checked in successfully.');

    }

    public function checkOut()
    {
        $attendance = AttendanceLog::where('user_id', Auth::id())
            ->whereNull('clock_out_time')
            ->latest()
            ->first();

        if ($attendance) {
            $attendance->clock_out_time = now();
            $attendance->save();
            return redirect()->route('employee.dashboard')->with('success', 'Checked out successfully.');
        }

        return redirect()->route('employee.dashboard')->with('error', 'You need to check in first.');
    }

    // show the requestLeave form
    public function showRequestLeaveForm(){

        return view('employee.requestLeave');
    }

    // Handle leave request submission
    public function requestLeave(Request $request)
    {
        // Validate the request data
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Create the leave request
        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        // Redirect with a success message
        return redirect()->route('employee.requestLeave')->with('success', 'Leave request submitted successfully.');
    }

    // Method to display the employee`s Leave Request
    public function viewLeaveRequests()
    {
        // Get the leave requests for the logged-in employee
        $leaveRequests = LeaveRequest::where('user_id', auth()->id()) // Add auth()->id() to get the user's ID
        ->orderBy('created_at', 'desc')
        ->get();

        // Pass the leave requests to the view
        return view('employee.leaveRequests', compact('leaveRequests'));
    }


}
