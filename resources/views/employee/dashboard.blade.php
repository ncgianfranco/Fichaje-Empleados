<!-- resources/views/employee/dashboard.blade.php -->
@extends('layouts.app')
@extends('employee.employee-layouts.employee-menu')

@section('title-name', 'Dashboard')

@section('content')
<div class="container">
    <h2>Panel Empleado</h2>

    <!-- Registros de Asistencia -->
    <h3>Registros de Asistencia</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Entrada</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceRecords as $record)
                <tr>
                    <td>{{ $record->created_at}}</td>
                    <td>{{ $record->clock_in_time }}</td>
                    <td>{{ $record->clock_out_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Check In/Out Buttons -->
    <form action="{{ route('employee.checkin') }}" method="POST">
        @csrf
        <button type="button" onclick="setCurrentTime('confirmModalCheckIn')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModalCheckIn">Fichar</button>
        <x-popup title="¿Realizar check in?" body="Se registrará a las" target="confirmModalCheckIn">
            <span class="check-time"></span>
        </x-popup>
    </form>
    <form action="{{ route('employee.checkout') }}" method="POST">
        @csrf
        <button type="button" onclick="setCurrentTime('confirmModalCheckOut')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModalCheckOut">Fichar Salida</button>
        <x-popup title="¿Realizar check out?" body="Se registrará a las" target="confirmModalCheckOut">
            <span class="check-time"></span>
        </x-popup>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/currentTime.js') }}"></script>
@endsection