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
                    @php
                        $todayRecord = $attendanceRecords->where('created_at', '>=', now()->startOfDay())
                                                         ->where('created_at', '<=', now()->endOfDay())
                                                         ->first();
                    @endphp
                    @if($todayRecord && $todayRecord->clock_in_time)
                        {{ $todayRecord->clock_in_time }}
                    @else
                        No registrada
                    @endif
                </span>
            </p>
            
            <p><strong>Hora de Salida:</strong> 
                <span class="text-danger">
                    @if($todayRecord && $todayRecord->clock_out_time)
                        {{ $todayRecord->clock_out_time }}
                    @else
                        No registrada
                    @endif
                </span>
            </p>
            <!-- Botones para Fichar Entrada y Salida -->
            <form action="{{ route('employee.checkin') }}" method="POST">
                @csrf
                <button type="button" onclick="setCurrentTime('confirmModalCheckIn')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModalCheckIn">Fichar</button>
                <x-popup button="check-in" title="¿Realizar check in?" body="Se registrará a las" target="confirmModalCheckIn">
                    <span class="check-time"></span>
                </x-popup> 
            </form>
            <form action="{{ route('employee.checkout') }}" method="POST">
                @csrf
                <button type="button" onclick="setCurrentTime('confirmModalCheckOut')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModalCheckOut">Fichar Salida</button>
                <x-popup button="check-out" title="¿Realizar check out?" body="Se registrará a las" target="confirmModalCheckOut">
                    <span class="check-time"></span>
                </x-popup>
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
<script src="{{asset('js/currentTime.js')}}"></script>
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

