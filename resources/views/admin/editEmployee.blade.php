<!-- resources/views/admin/editEmployee.blade.php -->
@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')
@section('title-name', 'Edit Employee')

@section('content')
<div class="container">
    <h2>Editar Empleado</h2>
    
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

    <!-- Form for editing employee information -->
    <form action="{{ route('admin.updateEmployee', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
</div>
@endsection
