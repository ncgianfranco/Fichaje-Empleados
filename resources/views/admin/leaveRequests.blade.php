<!-- resources/views/admin/leaveRequests.blade.php -->
@extends('layouts.app')

@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Employee Leave Requests</h2>

    <form action="{{ route('admin.leaveRequestsSearch') }}" method="get">
        @csrf
        <label for="employee_email">Employee email:</label>
        <input type="text" id="employee_email" name="employee_email">
        <button type="submit"  name="employee_email_button">Search</button>
    </form>

    @if($leaveRequests->isEmpty())
        <p>No leave requests available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ ucfirst($request->leave_type) }}</td>
                        <td>{{ $request->start_date }}</td>
                        <td>{{ $request->end_date }}</td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>
                            <form action="{{ route('admin.updateLeaveStatus', $request->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select">
                                    <option value="approved" {{ $request->status === 'approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="rejected" {{ $request->status === 'rejected' ? 'selected' : '' }}>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
