<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Panel Supervisor</h2>
    <h3>Empleados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Email</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <a href="{{ route('admin.editEmployee', $employee->id) }}" class="btn btn-warning">Modificar</a>
                        <form action="{{ route('admin.deleteEmployee', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Attendance Records Section -->
    <h3>Registros de fichajes</h3>

    @if($attendanceRecords->isEmpty())
        <p>No hay fichajes registrados para hoy.</p>
    @else

        <table class="table">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Entrada</th>
                    <th>Salida</th>
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

