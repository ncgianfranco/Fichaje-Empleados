<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Para PDF


class PerformanceController extends Controller
{
    public function export(Request $request, $type)
    {
        // Consulta los datos filtrados
        $query = AttendanceLog::query();

        if ($request->email) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                return back()->with('error', 'No se encontraron registros para el correo proporcionado.');
            }
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('clock_in_time', [$request->start_date, $request->end_date]);
        }

        $logs = $query->orderBy('clock_in_time', 'desc')->get();

        if ($type === 'pdf') {
            $pdf = Pdf::loadView('admin.performance_pdf', compact('logs'));
            return $pdf->download('performance.pdf');
        } elseif ($type === 'csv') {
            $filename = 'performance.csv';
            $handle = fopen(storage_path('app/' . $filename), 'w');
            fputcsv($handle, ['Empleado', 'Fecha Entrada', 'Fecha Salida', 'Horas Trabajadas']);

            foreach ($logs as $log) {
                $hoursWorked = $log->clock_out_time && $log->clock_in_time 
                    ? $log->clock_in_time->diffInHours($log->clock_out_time) 
                    : 'N/A';
                fputcsv($handle, [
                    $log->user->email,
                    $log->clock_in_time,
                    $log->clock_out_time,
                    $hoursWorked
                ]);
            }

            fclose($handle);

            return response()->download(storage_path('app/' . $filename))->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Tipo de exportación no válido.');
    }
}
