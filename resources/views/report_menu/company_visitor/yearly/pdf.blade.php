<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Visitor Yearly Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h3>Visitor Yearly Report ({{ $year }})</h3>
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
                    <td colspan="6" class="text-center">No records found for {{ $year }}.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
