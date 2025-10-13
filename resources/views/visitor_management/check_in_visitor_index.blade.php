    @extends('adminlte::page')

    @section('title', 'Check-In Visitor')

    @section('content')
    <div class="container">
        <h2>Check-In Visitor</h2>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>VID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Purpose</th>
                    <th>Check-In Time</th>
                    <th>Total Check-Ins</th> <!-- Added Total Check-Ins Column -->
                </tr>
            </thead>
            <tbody>
                @forelse ($checkInVisitors as $checkin)
                    <tr>
                        <td>{{ $checkin->id }}</td>
                        <td>{{ $checkin->visitor->v_id }}</td>
                        <td>{{ $checkin->visitor->name }}</td> <!-- Fetch name from visitor relationship -->
                        <td>{{ $checkin->age }}</td>
                        <td>{{ $checkin->visitor->purpose }}</td> <!-- Fetch purpose from visitor relationship -->
                        <td>{{ \Carbon\Carbon::parse($checkin->check_in_time)->format('Y-m-d h:i A') }}</td> <!-- Formatted Time -->
                        <td>{{ $checkin->total_checkins }}</td> <!-- Show Total Check-Ins -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No visitors found for check-in.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="container mt-3">
            <h5>Total Check-Ins: {{ $totalVisitorCheckin }}</h5>
        </div>
    </div>
@stop