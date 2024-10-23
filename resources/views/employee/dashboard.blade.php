@extends('layouts.app')

@section('content')
<h1>Welcome Employee, {{ Auth::user()->name }}</h1>


{{--  

<form action="{{ route('attendance.clock_in') }}" method="POST">
    @csrf
    <button type="submit">Clock In</button>
</form>

<form action="{{ route('attendance.clock_out') }}" method="POST">
    @csrf
    <button type="submit">Clock Out</button>
</form>


<h2>Request Leave</h2>
<form action="{{ route('leave.submit') }}" method="POST">
    @csrf
    <label>Leave Type</label>
    <input type="text" name="leave_type" required>
    <label>Start Date</label>
    <input type="date" name="start_date" required>
    <label>End Date</label>
    <input type="date" name="end_date" required>
    <button type="submit">Submit Request</button>
</form>
--}}

@endsection
