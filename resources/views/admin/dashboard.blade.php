<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>

    <!-- Employee Management Section -->
    <h3>Manage Employees</h3>
    <a href="{{ route('admin.leaveRequests') }}" class="btn btn-primary">Go to view request of employees</a>
    <a href="{{ route('admin.addEmployee') }}" class="btn btn-primary">Add New Employee</a>
    <a href="{{ route('admin.performance') }}" class="btn btn-primary">Ver Rendimiento de Empleados</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>
                        <a href="{{ route('admin.editEmployee', $employee->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.deleteEmployee', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Attendance Records Section -->
    <h3>Attendance Records</h3>

    @if($attendanceRecords->isEmpty())
        <p>No hay fichajes registrados para hoy.</p>
    @else

        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceRecords as $record)
                    <tr>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->clock_in_time->format('H:i') }}</td>
                        <td>{{ $record->clock_out_time ? $record->clock_out_time->format('H:i') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    @endif
</div>
@endsection

