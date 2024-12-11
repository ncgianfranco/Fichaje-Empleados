<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
define('HOLIDAYS_AMOUNT', 30);


class EmployeeController extends Controller
{
    public function dashboard()
    {
        $employee = Auth::user();
        $attendanceRecords = AttendanceLog::where('user_id', $employee->id)->get();
        return view('employee.dashboard', compact('attendanceRecords'));
    }

    public function checkIn()
    {
        $attendance = new AttendanceLog();
        $attendance->user_id = Auth::id();
        $attendance->clock_in_time = now();
        $attendance->save();

        return redirect()->route('employee.dashboard')->with('success', 'Checked in successfully.');

    }

    public function checkOut()
    {
        $attendance = AttendanceLog::where('user_id', Auth::id())
            ->whereNull('clock_out_time')
            ->latest()
            ->first();

        if ($attendance) {
            $attendance->clock_out_time = now();
            $attendance->save();
            return redirect()->route('employee.dashboard')->with('success', 'Checked out successfully.');
        }

        return redirect()->route('employee.dashboard')->with('error', 'You need to check in first.');
    }

    // show the requestLeave form
    public function showRequestLeaveForm(){

        //Obtenemos los días restantes de vacaciones y fecha inicio contrato
        $employee = Auth::user();
        $start_date = \Carbon\Carbon::parse($employee->created_at);
        $spent_holidays = $employee->spent_holidays;

        $spent_holidays = $employee->spent_holidays;

        //Obtenemos antigüedad. A la fecha actual le restamos la fecha de ini contrato (y redondeamos)
        $seniority = round(now()->diffInDays($start_date, true));

        //Calculamos los días totales que le corresponden de vacaciones hasta día de hoy
        $totalHolidays = $seniority < 365 ? round($seniority * (HOLIDAYS_AMOUNT/365)) : HOLIDAYS_AMOUNT;

        return view('employee.requestLeave', compact('start_date', 'spent_holidays', 'totalHolidays'));
    }

    // Handle leave request submission
    public function requestLeave(Request $request)
    {
        $employee = User::findOrFail(Auth::id());
        $spent_holidays = $employee->spent_holidays;

        //Nos aseguramos de que los días solicitados < días restantes
        //Parseo de la fecha para poder hacer uso de las funciones de Carbon
        $leaveStartDate = \Carbon\Carbon::parse($request->start_date);
        $leaveEndDate = $request->end_date;

        //Calculamos cantidad de días solicitados (sin contar fines de semana)
        $days_requested = $leaveStartDate->diffInWeekdays($leaveEndDate);
        $days_requested++;

        // Calcular días totales de vacaciones generados; depende de su antigüedad
        $startContractDay = $employee->created_at;

        //Antiguedad del empleado (relativa al día que solicita empezar las vacaciones): fecha ini vacas - fecha ini contrato (en valor abs)
        $seniority = round($leaveStartDate->diffInDays($startContractDay, true));

        $totalHolidays = $seniority < 365 ? round($seniority * (HOLIDAYS_AMOUNT/365)) : HOLIDAYS_AMOUNT;

        //Cantidad de vacaciones que le quedan por gastar
        $holidays_left = $spent_holidays < $totalHolidays ? $totalHolidays - $spent_holidays : 0;

        //Opción 1: Redirigir por solicitados > días disponibles        
        if ($days_requested > $holidays_left) {
            return redirect()->back()->withErrors(['days_requested' => 'You do not have enough holidays availables.'])->withInput();
        }
        
        //Opción 2: Hay que incluir los campo días restantes y días solicitados para que validate lo pueda manejar
        // $request->merge(['holidays_left' => $holidays_left]);
        // $request->merge(['days_requested' => $days_requested]);

        // Validate the request data
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date'//,
            // 'days_requested' => 'lte:(holidays_left)'
        ]);        
        
        // Create the leave request
        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);
        
        //Actualizamos el campo días gastados (para que, aunque aún no han sido aprobados, el usuario no pueda seleccionar vacaciones sin control)
        $spent_holidays += $days_requested;
        
        //Comprobar qué tipo de leave pidió (vacaciones,sick)
        
        if($request->leave_type == "annual"){
            $employee->update(['spent_holidays' => $spent_holidays]);
            // Redirect with a success message
            return redirect()->route('employee.requestLeave')->with('success', 'Peticion enviada.');
        }

        return redirect()->route('employee.requestLeave')->with('success', 'Peticion enviada.');

    }

    // Method to display the employee`s Leave Request
    public function viewLeaveRequests()
    {
        // Get the leave requests for the logged-in employee
        $leaveRequests = LeaveRequest::where('user_id', auth()->id()) // Add auth()->id() to get the user's ID
        ->orderBy('created_at', 'desc')
        ->get();

        // Pass the leave requests to the view
        return view('employee.leaveRequests', compact('leaveRequests'));
    }

    //Devolvemos los días de la petición cancelada al usuario y la borramos
    public function deleteLeaveRequest($id) {
        $request = LeaveRequest::findOrFail($id);

        //Devolvemos al usuario los días que gastó en esta petición
        $days_requested = \Carbon\Carbon::parse($request->start_date)->diffInWeekdays($request->end_date);
        $days_requested++;

        $employee = User::findOrFail($request->user_id);

        if($request->leave_type == "annual")
            $employee->decrement('spent_holidays', $days_requested);

        $request->delete();

        return redirect()->route('employee.leaveRequests')->with('success', 'Peticion borrada.');
    }

}
