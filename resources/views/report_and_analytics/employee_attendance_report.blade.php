<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Employee Attendance Report</h2>
    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Check-In Time</th>
                <th>Check-Out Time</th>
                <th>Total Check-ins</th>
                <th>Total Check-outs</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendanceRecords as $attendance)
                <tr>
                    <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                    <td>{{ optional($attendance->check_in_time)->format('h:i A') ?? 'N/A' }}</td>
                    <td>{{ optional($attendance->check_out_time)->format('h:i A') ?? 'N/A' }}</td>
                    <td>{{ $attendance->total_checkins }}</td>
                    <td>{{ $attendance->total_checkouts }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
