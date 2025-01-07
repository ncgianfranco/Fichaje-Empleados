<!-- resources/views/employee/leaveRequests.blade.php -->
@extends('layouts.app')
@extends('employee.employee-layouts.employee-menu')

@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Peticiones Realizadas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($leaveRequests->isEmpty())
        <p>No tienes peticiones pendientes.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo de petición</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Estado</th>
                    <th>Solicitado</th>
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
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($request->status === 'approved')
                                <span class="badge bg-success">Aprovada</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge bg-danger">Rechazada</span>
                            @endif
                        </td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('employee.deleteLeaveRequest', $request->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <!-- Añadimos el id de la petición al identificador del modal para que cada uno sea único -->
                                <button type="button" value="Cancelar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModalCancelRequest{{ $request->id }}">Cancelar</button>
                                <x-popup title="¿Cancelar petición?" body="Se cancelará la petición y se devolverán los días solicitados" target="confirmModalCancelRequest{{ $request->id }}" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
