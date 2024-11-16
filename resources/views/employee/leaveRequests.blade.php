<!-- resources/views/employee/leaveRequests.blade.php -->
@extends('layouts.app')

@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Your Leave Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($leaveRequests->isEmpty())
        <p>You have no leave requests.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Request Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $request)
                    <tr>
                        <td>{{ ucfirst($request->leave_type) }}</td>
                        <td>{{ $request->start_date }}</td>
                        <td>{{ $request->end_date }}</td>
                        <td>
                            @if($request->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($request->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('employee.deleteLeaveRequest', $request->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Cancelar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
