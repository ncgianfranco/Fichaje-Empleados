<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AttendanceLog;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('role', 'employee')->get(); // Fetch all employees

        // Fetch attendance logs along with associated user details
        $attendanceRecords = AttendanceLog::with('user')->orderBy('clock_in_time', 'desc')->get();
        return view('admin.dashboard', compact('employees', 'attendanceRecords'));
    }

    // add employee
    public function addEmployee()
    {
        return view('admin.addEmployee');
    }

    // store employee
    public function storeEmployee(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'employee',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employee added successfully.');
    }


    // edit employee
    public function editEmployee($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.editEmployee', compact('employee'));
    }

    //  update employee
    public function updateEmployee(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $employee->update($request->only(['name', 'email']));

        return redirect()->route('admin.dashboard')->with('success', 'Employee updated successfully.');
    }

    //  delete employee
    public function deleteEmployee($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Employee deleted successfully.');
    }

    // display all employee leave request
    public function viewLeaveRequests()
    {
        // Retrieve all leave requests along with the user details
        $leaveRequests = LeaveRequest::with('user')->orderBy('created_at', 'desc')->get();

        // Pass leave requests to the view
        return view('admin.leaveRequests', compact('leaveRequests'));
    }


    // Validate the status input
    public function updateLeaveStatus(Request $request, $id)
    {
    
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Find the leave request by ID and update its status
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = $request->status;
        $leaveRequest->save();

        // Redirect back with a success message
        return redirect()->route('admin.leaveRequests')->with('success', 'Leave request status updated successfully.');
    }
}
