<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AttendanceLog;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Paginación de empleados
        $employees = User::where('role', 'employee')->get(); // Paginamos los empleados de 10 en 10
    
        // Obtener la fecha de hoy
        $today = now()->toDateString();
    
        // Paginación de registros de fichaje
        $attendanceRecords = AttendanceLog::whereDate('clock_in_time', $today)->get(); // Paginación para los registros de hoy
    
        // Pasamos los datos a la vista
        return view('admin.dashboard', compact('employees', 'attendanceRecords'));
    }

    // add employee
    public function addEmployee()
    {
        return view('admin.addEmployee');
    }

    // store employee
    public function storeEmployee(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'employee',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Empleado creado correctamente.');
    }


    // edit employee
    public function editEmployee($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.editEmployee', compact('employee'));
    }

    //  update employee
    public function updateEmployee(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $employee->update($request->only(['name', 'email']));

        return redirect()->route('admin.dashboard')->with('success', 'Empleado actualizado correctamente.');
    }

    //  delete employee
    public function deleteEmployee($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Empleado eliminado correctamente.');
    }

    // display all employee leave request
    public function viewLeaveRequests()
    {
        // Retrieve all leave requests along with the user details
        $leaveRequests = LeaveRequest::with('user')->orderBy('created_at', 'desc')->get();

        // Pass leave requests to the view
        return view('admin.leaveRequests', compact('leaveRequests'));
    }


    // Validate the status input
    public function updateLeaveStatus(Request $request, $id)
    {
    
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Find the leave request by ID and update its status
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = $request->status;
        $leaveRequest->save();

        //Actualizamos el campo días gastados si fue rechazada (cuando el empleado hace una petición de vacaciones, cuentan como días gastados a pesar de no haber sido aprobados aún)
        if($request->status == "rejected" && $leaveRequest->leave_type == "annual"){
            //Calculamos cantidad de días solicitados
            $leaveStartDate = \Carbon\Carbon::parse($leaveRequest->start_date);
            $leaveEndDate = $leaveRequest->end_date;
    
            $days_requested = ($leaveStartDate->diffInWeekdays($leaveEndDate, true));
            $days_requested++;
    
            //Actualizamos los días gastados del usuario (en este caso, le devolvemos los días puesto que ha sido rechazada)
            User::findOrFail($leaveRequest->user_id)->decrement('spent_holidays', $days_requested);
        }

        // Redirect back with a success message
        return redirect()->route('admin.leaveRequests')->with('success', 'Peticion actualizada');
    }

    public function searchEmployeeRequests(Request $request) {
        // Filtra requests por email de usuario
        $user_id = User::select('id')->where('email', 'like', '%' . $request->employee_email . '%');

        $leaveRequests = LeaveRequest::with('user')->whereIn('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('admin.leaveRequests', compact('leaveRequests'));
    }

    //MÉTODOS PARA LAS VISTA DE RENDIMIENTO -> BY GIANFRANCO
    
    public function viewPerformance(){
        //retorna la vista performance sin datos filtrados
        return view('admin.performance', ['logs' => [], 'filtered' => false]);
    }

    public function filterPerformance(Request $request)
    {
        $query = AttendanceLog::query();

        // Si no se envía ningún filtro, devuelve una vista vacía
        if (!$request->hasAny(['email', 'start_date', 'end_date']) || 
            (!$request->email && !$request->start_date && !$request->end_date)) {
            return view('admin.performance', [
                'logs' => collect(), // Colección vacía
                'filtered' => false, // Indica que no hay filtros aplicados
            ]);
        }

        // Filtrado por correo electrónico del empleado si se proporciona
        if ($request->has('email') && $request->email) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                return redirect()->route('admin.performance')
                    ->with('error', 'No se encontraron registros para el correo proporcionado.');
            }
        }

        // Filtrado por rango de fechas si se proporciona
        if ($request->has('start_date') && $request->start_date && 
            $request->has('end_date') && $request->end_date) {
            $query->whereBetween('clock_in_time', [$request->start_date, $request->end_date]);
        }

        // Obtiene los registros filtrados
        $logs = $query->orderBy('clock_in_time', 'desc')->get();

        // Retorna la vista de rendimiento con los registros filtrados
        return view('admin.performance', [
            'logs' => $logs,
            'filtered' => true,
            'filters' => $request->only(['email', 'start_date', 'end_date']), // Para mantener los valores del formulario
        ]);

    }
}
