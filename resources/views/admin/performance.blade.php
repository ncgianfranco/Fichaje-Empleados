@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')

@section('title-name', 'Performance Employees')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Filtrar Registros de Asistencia de Empleados</h2>
    <!-- Formulario de Filtro -->
    <form method="POST" action="{{ route('admin.performance.filter') }}" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo del empleado:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese el correo del empleado" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de inicio:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Fecha de finalización:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <!-- Resultados Filtrados -->
    @if($filtered)
        <div class="mt-4">
            @if(count($logs) > 0)
                <!-- Botones de Exportación -->
                <div class="d-flex justify-content-start mb-3">
                    <form action="{{ route('admin.export', ['type' => 'pdf']) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-danger me-3">Exportar a PDF</button>
                    </form>

                    <form action="{{ route('admin.export', ['type' => 'csv']) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-success">Exportar a CSV</button>
                    </form>
                </div>

                <!-- Tabla de Registros -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Empleado</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Horas Trabajadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                @php
                                    // Cálculo de la duración en horas y minutos
                                    $minutesWorked = $log->clock_in_time && $log->clock_out_time ? $log->clock_in_time->diffInMinutes($log->clock_out_time) : 0;
                                    $hours = floor($minutesWorked / 60);
                                    $minutes = $minutesWorked % 60;
                                @endphp
                                <tr>
                                    <td>{{ $log->user->name }}</td>
                                    <td>{{ $log->clock_in_time->format('H:i') }}</td>
                                    <td>{{ $log->clock_out_time ? $log->clock_out_time->format('H:i') : 'N/A' }}</td>
                                    <td>{{ $minutesWorked ? "{$hours} horas y {$minutes} minutos" : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No se encontraron registros para el filtro aplicado.</p>
            @endif
        </div>
    @endif
</div>
@endsection
