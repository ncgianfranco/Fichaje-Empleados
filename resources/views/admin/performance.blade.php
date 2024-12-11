@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')
@section('title-name', 'Performance Employees')

@section('content')

<div class="container">
<form method="POST" action="{{ route('admin.performance.filter') }}">
    @csrf
    <div class="mb-3">
        <label for="email">Correo del empleado:</label>
        <input type="email" id="email" name="email" placeholder="Ingrese el correo del empleado">
    </div>
    <div class="mb-3">
        <label for="start_date">Fecha de inicio:</label>
        <input type="date" id="start_date" name="start_date">
    </div>
    <div class="mb-3">
        <label for="end_date">Fecha de finalización:</label>
        <input type="date" id="end_date" name="end_date">
    </div>    
    <button type="submit">Filtrar</button>
</form>

@if($filtered)
    @if(count($logs) > 0)
        <!--Botones para exportar -->
        <form action="{{ route('admin.export', ['type' => 'pdf']) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <button type="submit" class="btn btn-danger">Exportar a PDF</button>
        </form>
    
        <form action="{{ route('admin.export', ['type' => 'csv']) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <button type="submit" class="btn btn-success">Exportar a CSV</button>
        </form>
        <!-- Mostrar resultados -->
        <table>
            <thead>
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
    @else
        <p>No se encontraron registros para el filtro aplicado.</p>
    @endif
</div>
@endif
@endsection