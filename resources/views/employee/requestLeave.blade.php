<!-- resources/views/employee/requestLeave.blade.php -->
@extends('layouts.app')

@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Request Leave</h2>

    <!-- Display any success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>Your contract started on {{ $start_date }}</p>

    <p>Since then you have generated {{ $totalHolidays}} holidays. You have spent (or pending to approve) {{ $spent_holidays }} of them</p>

    <!-- Leave Request Form -->
    <form action="{{ route('employee.requestLeave') }}" method="POST">
        @csrf

        <!-- Leave Type Field -->
        <div class="mb-3">
            <label for="leave_type" class="form-label">Leave Type</label>
            <select name="leave_type" id="leave_type" class="form-select" required>
                <option value="sick">Sick Leave</option>
                <option value="annual">Annual Leave</option>
                <option value="unpaid">Unpaid Leave</option>
            </select>
        </div>

        <!-- Start Date Field -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <!-- End Date Field -->
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
@endsection
