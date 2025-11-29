<!DOCTYPE html>
<html>

<head>
    <title>Employee Yearly Report - {{ $year }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Employee Yearly Report</h2>
    <p><strong>Year:</strong> {{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Check-in Date</th>
                <th>Check-in Time</th>
                <th>Check-out Date</th>
                <th>Check-out Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                    <td>{{ $attendance->check_in_date }}</td>
                    <td>{{ $attendance->check_in_time }}</td>
                    <td>{{ $attendance->check_out_date ?? '-' }}</td>
                    <td>{{ $attendance->check_out_time ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No records found for this year.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
