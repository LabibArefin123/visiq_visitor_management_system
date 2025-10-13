<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Visitor Report</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Visitor ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Check-In Time</th>
                <th>Check-Out Time</th>
                <th>Total Check-Ins</th>
                <th>Total Check-Outs</th>
                <th>Duration</th>
            </tr>
        </thead>
        @if ($visitorReports->isNotEmpty())
            <tbody>
                @foreach ($visitorReports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->visitor->v_id ?? 'N/A' }}</td>
                        <td>{{ $report->visitor->name ?? 'N/A' }}</td>
                        <td>{{ $report->visitor->email ?? 'N/A' }}</td>
                        <td>{{ $report->visitor->age ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($report->check_in_time)->format('d-m-Y h:i A') ?? 'N/A' }}</td>
                        <td>{{ $report->check_out_time ? \Carbon\Carbon::parse($report->check_out_time)->format('d-m-Y h:i A') : 'N/A' }}
                        </td>
                        <td>{{ $report->total_checkins }}</td>
                        <td>{{ $report->total_checkouts }}</td>
                        <td>{{ $report->duration ? floor($report->duration / 60) . ' hrs ' : '0 hrs' }}{{ $report->duration % 60 }}
                            min</td>
                    </tr>
                @endforeach
            </tbody>
        @else
            <tr>
                <td colspan="10" class="text-center">No data available.</td>
            </tr>
        @endif

    </table>

</body>

</html>
