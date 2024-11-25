@extends('layouts.app')

@section('title-name', 'Add Employee')

@section('content')
<h1>Nuevo Usuario</h1>
<form method="POST" action="{{ route('admin.storeEmployee') }}">
    @csrf
    <div>
        <label for="name">Name</label>
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
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required />
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation"/>
    </div>

    <button type="submit">Crear Empleado</button>
</form>
@endsection