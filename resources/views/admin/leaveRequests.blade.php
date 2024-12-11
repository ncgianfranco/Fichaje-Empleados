<!-- resources/views/admin/leaveRequests.blade.php -->
@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')
@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Peticiones Empleados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.leaveRequestsSearch') }}" method="get">
        @csrf
        <label for="employee_email">Filtrar</label>
        <input type="text" id="employee_email" name="employee_email">
        <button type="submit"  name="employee_email_button">Buscar</button>
    </form>

    @if($leaveRequests->isEmpty())
        <p>No hay peticiones disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo de petición</th>
                    <th>Inicio</th>
                    <th>Hasta</th>
                    <th>Estado</th>
                    <th></th>
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
                                    <option value="approved" {{ $request->status === 'approved' ? 'selected' : '' }}>Aprobado</option>
                                    <option value="rejected" {{ $request->status === 'rejected' ? 'selected' : '' }}>Rechazado</option>
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
