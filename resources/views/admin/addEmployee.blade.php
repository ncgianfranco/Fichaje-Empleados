@extends('layouts.app')
@extends('admin.admin-layouts.admin-menu')
@section('title-name', 'Add Employee')

@section('content')
<h1>Nuevo Usuario</h1>
<form method="POST" action="{{ route('admin.storeEmployee') }}">
    @csrf
    <div>
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" value="{{old('name')}}" required autofocus />
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{old('email')}}" required/>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" required />
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input id="password_confirmation" type="password" name="password_confirmation"/>
    </div>

    <button type="button" value="Crear Empleado" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModalAddEmployee">Crear Empleado</button>
    <x-popup title="¿Crear usuario?" body="Se creará el usuario con los datos introducidos" target="confirmModalAddEmployee" />
</form>
@endsection