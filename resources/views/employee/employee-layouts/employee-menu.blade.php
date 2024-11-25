@section('menu-options')
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('employee.showRequestLeave') }}">Applay Request</a>
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('employee.leaveRequests') }}">View Requests</a>
</li>
@endsection