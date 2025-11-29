<!DOCTYPE html>
<html>

<head>
    <title>Visitor Daily Report - {{ $date }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Visitor Daily Report</h2>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Visitor Name</th>
                <th>Employee (Host)</th>
                <th>Meeting Date</th>
                <th>Purpose</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visits as $visit)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $visit->visitor->name ?? 'N/A' }}</td>
                    <td>{{ $visit->employee->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($visit->meeting_date)->format('d M Y, h:i A') }}</td>
                    <td>{{ $visit->purpose }}</td>
                    <td>{{ ucfirst($visit->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">No visitor records for this date.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
