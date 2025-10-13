<!DOCTYPE html>
<html>
<head>
    <title>Visitor Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Visitor Report</h1>
    <p>Start Date: {{ $validated['start_date'] ?? 'N/A' }}</p>
    <p>End Date: {{ $validated['end_date'] ?? 'N/A' }}</p>
    <p>Visitor Type: {{ $validated['visitor_type'] ?? 'All' }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
                <th>Total Check-ins</th>
                <th>Total Check-outs</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->phone }}</td>
                    <td>{{ $visitor->check_in_time }}</td>
                    <td>{{ $visitor->check_out_time }}</td>
                    <td>{{ $visitor->total_checkins ?? 'N/A' }}</td>
                    <td>{{ $visitor->total_checkouts ?? 'N/A' }}</td>
                    <td>
                        @if ($visitor->check_in_time && $visitor->check_out_time)
                            @php
                                $checkIn = \Carbon\Carbon::parse($visitor->check_in_time);
                                $checkOut = \Carbon\Carbon::parse($visitor->check_out_time);
                                $duration = $checkOut->diff($checkIn);
                            @endphp
                            {{ $duration->format('%h hours %i minutes') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
