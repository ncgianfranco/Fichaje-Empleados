@section('menu-options')
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('employee.showRequestLeave') }}">Solicitar Peticiones</a>
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('employee.leaveRequests') }}">Ver Peticiones</a>
</li>
@endsection