<!-- resources/views/employee/requestLeave.blade.php -->
@extends('layouts.app')
@extends('employee.employee-layouts.employee-menu')

@section('title-name', 'Requests')

@section('content')
<div class="container">
    <h2>Solicitar Petición</h2>

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

    <p>El contrato empezo {{ $start_date }}</p>

    <p>Se ha generado {{ $totalHolidays}} dias de vacaciones. Has usado (o pendiente a aprobado) {{ $spent_holidays }}</p>

    <!-- Leave Request Form -->
    <form action="{{ route('employee.requestLeave') }}" method="POST">
        @csrf

        <!-- Leave Type Field -->
        <div class="mb-3">
            <label for="leave_type" class="form-label">Tipo de petición</label>
            <select name="leave_type" id="leave_type" class="form-select" required>
                <option value="sick">Enfermedad</option>
                <option value="annual">Anual</option>
                <option value="unpaid">No pagado</option>
            </select>
        </div>

        <!-- Start Date Field -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Empieza</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <!-- End Date Field -->
        <div class="mb-3">
            <label for="end_date" class="form-label">Hasta</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Solicitar</button>
    </form>
</div>
@endsection
