@extends('adminlte::page')

@section('title', 'Employee Attendance')

@section('content')
    <div class="container">
        <h2>Employee Attendance</h2>

        <!-- Search Form -->
        <div class="mb-3">
            <form method="GET" action="{{ route('attendance_tracking') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by Employee Name"
                        value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($attendanceRecords as $attendance)
                <tr>
                    <td>{{ $attendance->name }}</td>
                    <td>{{ $attendance->checkIn ? \Carbon\Carbon::parse($attendance->checkIn->check_in_time)->format('h:i A') : 'Not Checked In' }}
                    </td>
                    <td>{{ $attendance->checkOut ? \Carbon\Carbon::parse($attendance->checkOut->check_out_time)->format('h:i A') : 'Not Checked Out' }}
                    </td>
                    <td>
                        @if (!$attendance->checkIn)
                            <a href="{{ route('attendance.checkin', $attendance->id) }}"
                                class="btn btn-success btn-sm">Check In</a>
                        @elseif (!$attendance->checkOut)
                            <a href="{{ route('attendance.checkout', $attendance->id) }}"
                                class="btn btn-warning btn-sm">Check Out</a>
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>

        <!-- Pagination -->

    </div>
@stop