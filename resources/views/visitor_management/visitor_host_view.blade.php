@extends('adminlte::page')

@section('title', 'Visitor Host View')
@section('content')
<div class="container">
    <h2>Schedule Details</h2>
    <table class="table">
        <tr>
            <th>Visitor Name</th>
            <td>{{ $schedule->visitor->name }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $schedule->visitor->date_of_birth }}</td>
        </tr>
        <tr>
            <th>Age</th>
            <td>{{ $schedule->visitor->age }}</td>
        </tr>
        <tr>
            <th>Host/Employee Name</th>
            <td>{{ $schedule->employee_name }}</td>
        </tr>
        <tr>
            <th>Check-in Time</th>
            <td>{{ \Carbon\Carbon::parse($schedule->check_in_time)->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
            <th>Check-out Time</th>
            <td>{{ $schedule->check_out_time ? \Carbon\Carbon::parse($schedule->check_out_time)->format('Y-m-d H:i:s') : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Expected Check-out Time</th>
            <td>{{ \Carbon\Carbon::parse($schedule->expected_check_out_time)->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>
    <a href="{{ route('visitor_schedule.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
@section('footer')
    <div style="position: fixed; bottom: 5px; right: 5px; text-align: middle;">
        <p class="text-muted medium">
            Design and Developed by
            <a href="https://www.totalofftec.com" target="_blank" style="color: #007bff;">TOTALOFFTEC</a>
        </p>
    </div>
@endsection