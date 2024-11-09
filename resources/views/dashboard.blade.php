@extends('layouts.app')

@section('title-name', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Welcome to your Dashboard, {{ $user->name }}!</h1>
        <p>Your email is: {{ $user->email }}</p>
        <br>
        <a href="{{route('logout')}}">Logout</a>
    </div>
@endsection