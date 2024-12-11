@section('menu-options')
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.leaveRequests') }}">Peticiones Empleados</a>
    <!-- <a href="{{ route('admin.leaveRequests') }}" class="nav-link active">Go to view request of employees</a> -->
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.performance') }}">Rendimiento Empleados</a>
</li>
<li class="nav-item border-light border-top">
    <a class="nav-link active" href="{{ route('admin.addEmployee') }}">Crear Empleado</a>
    <!-- <a href="{{ route('admin.addEmployee') }}" class="btn btn-primary">Add New Employee</a> -->
</li>
@endsection