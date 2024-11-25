<!-- resources/views/employee/dashboard.blade.php -->
@extends('layouts.app')
@extends('employee.employee-layouts.employee-menu')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Employee Dashboard</h2>

    <!-- Attendance History -->
    <h3>Attendance Records</h3>
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
                    <td>{{ $record->created_at}}</td>
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
</div>
@endsection

