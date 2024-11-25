<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Rendimiento</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Rendimiento</h1>
    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Horas Trabajadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->user->email }}</td>
                    <td>{{ $log->clock_in_time }}</td>
                    <td>{{ $log->clock_out_time }}</td>
                    <td>
                        {{ $log->clock_out_time && $log->clock_in_time 
                            ? $log->clock_in_time->diffInHours($log->clock_out_time) 
                            : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
