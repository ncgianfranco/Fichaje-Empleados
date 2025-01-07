<!-- resources/views/employee/dashboard.blade.php -->
@extends('layouts.app')
@extends('employee.employee-layouts.employee-menu')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Panel Empleado</h2>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Fichaje del día actual -->
    <div class="card mb-4">
        <div class="card-header text-center">
            <h5>Fichaje de Hoy</h5>
        </div>
        <div class="card-body text-center">
            <p><strong>Hora de Entrada:</strong> 
                <span class="text-success">
                    @if($attendanceRecords->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->first()->clock_in_time)
                        {{ $attendanceRecords->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->first()->clock_in_time }}
                    @else
                        No registrada
                    @endif
                </span>
            </p>
            
            <p><strong>Hora de Salida:</strong> 
                <span class="text-danger">
                    @if($attendanceRecords->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->first()->clock_out_time)
                        {{ $attendanceRecords->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->first()->clock_out_time }}
                    @else
                        No registrada
                    @endif
                </span>
            </p>
            <!-- Botones para Fichar Entrada y Salida -->
            <form action="{{ route('employee.checkin') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-50 mb-2">Fichar Entrada</button>
            </form>
            <form action="{{ route('employee.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-50">Fichar Salida</button>
            </form>   
        </div>
    </div>

    <button id="toggleRecords" class="btn btn-info mb-3">Ver Registros Pasados</button>
    <div id="pastRecords" style="display: none;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceRecords as $record)
                    @if($record->created_at->toDateString() != now()->toDateString())
                        <tr>
                            <td>{{ $record->created_at->toDateString() }}</td>
                            <td>{{ $record->clock_in_time ?? 'No registrada' }}</td>
                            <td>{{ $record->clock_out_time ?? 'No registrada' }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Mostrar/ocultar registros pasados
    document.getElementById('toggleRecords').addEventListener('click', function () {
        const pastRecords = document.getElementById('pastRecords');
        if (pastRecords.style.display === 'none') {
            pastRecords.style.display = 'block';
            this.innerText = 'Ocultar Registros Pasados';
        } else {
            pastRecords.style.display = 'none';
            this.innerText = 'Ver Registros Pasados';
        }
    });
</script>
@endsection
