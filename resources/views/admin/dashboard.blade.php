@extends('layouts.app')

@section('content')
<h1>Welcome Admin, {{ Auth::user()->name }}</h1>
<!-- Add admin-specific dashboard features here -->
@endsection
