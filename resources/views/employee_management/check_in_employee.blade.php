@extends('adminlte::page')

@section('title', 'Check-In Employee')

@section('content')
    <div class="container">
        <h2>Check-In Employee</h2>


        <!-- Employee Check-In Table -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>EID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Department</th>
                    <th>Check-In Time</th>
                    <th>Status</th>
                    <th>Total Check In</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($checkInEmployees as $checkInEmployee)
                    @php
                        // Parse the check-in time
                        $checkInTime = $checkInEmployee->check_in_time
                            ? \Carbon\Carbon::parse($checkInEmployee->check_in_time)
                            : null;

                        // Determine status based on time range
                        if ($checkInTime) {
                            if (
                                $checkInTime->between(
                                    \Carbon\Carbon::createFromTime(8, 0),
                                    \Carbon\Carbon::createFromTime(10, 0),
                                )
                            ) {
                                $status = 'Regular'; // Check-in between 8:00 - 10:00 AM
                            } elseif ($checkInTime->gt(\Carbon\Carbon::createFromTime(10, 0))) {
                                $status = 'Late'; // After 10:00 AM
                            } else {
                                $status = 'Pending';
                            }
                        } else {
                            $status = 'Pending';
                        }
                    @endphp

                    <tr>
                        <td>{{ $checkInEmployee->employee->id }}</td> {{-- Assuming `employee` is a relation --}}
                        <td>{{ $checkInEmployee->employee->E_id }}</td>
                        <td>{{ $checkInEmployee->employee->name }}</td>
                        <td>{{ $checkInEmployee->employee->age }}</td>
                        <td>{{ $checkInEmployee->employee->department }}</td>
                        <td>{{ $checkInTime ? $checkInTime->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>{{ $status }}</td>
                        <td>{{ $checkInEmployee->total_checkins }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No employees found for check-in.</td>
                    </tr>
                @endforelse
            </tbody>


        </table>
        <div class="container mt-3">
            <h5>Total Employee Check-Ins: {{ $totalEmployeeCheckIn }}</h5>
        </div>
        
        
    </div>
@stop
