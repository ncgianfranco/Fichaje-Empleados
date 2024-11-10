<!-- resources/views/employee/dashboard.blade.php -->
@extends('layouts.app')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Employee Dashboard</h2>

    <!-- Attendance History -->
    <h3>Attendance Records</h3>
    <a href="{{ route('employee.showRequestLeave') }}" class="btn btn-primary">Add Request</a>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Clock In</th>
                <th>Clock Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceRecords as $record)
                <tr>
                    <td>{{ $record->created_at->toDateString() }}</td>
                    <td>{{ $record->clock_in_time }}</td>
                    <td>{{ $record->clock_out_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Check In/Out Buttons -->
    <form action="{{ route('employee.checkin') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Check In</button>
    </form>
    <form action="{{ route('employee.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Check Out</button>
    </form>
    <a href="{{ route('employee.leaveRequests') }}" class="btn btn-primary">View Request</a>
</div>
@endsection

