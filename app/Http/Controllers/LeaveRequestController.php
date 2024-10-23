<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function submitLeave(Request $request) {
        $validated = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'pending',
        ]);
    
        return redirect()->back()->with('success', 'Leave request submitted');
    }
    
    public function approveLeave($id) {
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Leave approved');
    }
    
}
