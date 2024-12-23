@extends('layouts.app')

@section('title-name', 'Login')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Login</h1>
        <form class="px-5 py-3" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="container">
               <div class="row flex justify-content-center mb-3">
                   <div class="col-lg-6">
                       <label class="form-label" for="email">Email</label>
                       <input id="email" class="form-control col-2" type="email" name="email" value="{{ old('email') }}">
                       @error('email')
                            <div class="text-danger">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
                <div class="row flex justify-content-center mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" for="password">Password</label>
                        <input id = "password" type="password" name="password" class="form-control">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row flex justify-content-center mb-3">
                    <div class="col-lg-6 text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
                <div class="row flex justify-content-center mb-3">
                    <div class="col-lg-6 text-center">
                        <p class="link-underline"> ¿Olvidaste tu contraseña? <a class="link-underline link-underline-opacity-0 link-offset-3-hover link-underline-opacity-75-hover" href="{{ route('password.request')}}"> Recuperar contraseña </a></p>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        </form>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/hideMenu.js') }}"></script>
@endsection