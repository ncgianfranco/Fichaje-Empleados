@section('menu-options')
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.leaveRequests') }}">View Requests</a>
    <!-- <a href="{{ route('admin.leaveRequests') }}" class="nav-link active">Go to view request of employees</a> -->
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.performance') }}">Employees Performance</a>
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.addEmployee') }}">Add New Employee</a>
    <!-- <a href="{{ route('admin.addEmployee') }}" class="btn btn-primary">Add New Employee</a> -->
</li>
@endsection