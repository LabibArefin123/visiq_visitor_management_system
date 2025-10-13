@extends('adminlte::page')

@section('title', 'Employee Attendance Reports')

@section('content')
    <div class="container">
        <h2>Employee Attendance Reports</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filter Form -->
        <form method="POST" action="{{ route('employee_attendance_report.generate') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="employee_id">Employee</label>
                    <select class="form-control" id="employee_id" name="employee_id">
                        <option value="">All</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Buttons Container for Center Alignment with Adjusted Button Size -->
                <div class="col-md-3 d-flex justify-content-center align-items-center mt-3">
                    <button type="submit" class="btn btn-primary mr-2" style="padding: 5px 10px; font-size: 14px; min-width: 120px;">Generate Report</button>
                    <button type="submit" formaction="{{ route('employee_attendance_report.download') }}" formmethod="POST"
                        class="btn btn-danger" style="padding: 5px 10px; font-size: 14px; min-width: 120px;">
                        Download PDF
                    </button>
                </div>
            </div>
        </form>
        


        @isset($attendanceRecords)
            <h4 class="mt-4">Attendance Report</h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Check-In Time</th>
                        <th>Check-Out Time</th>
                        <th>Total Check-ins</th>
                        <th>Total Check-outs</th>
                        <th>Duration</th> <!-- Time Difference -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendanceRecords as $index => $attendance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $checkIn = $attendance->check_in_time ? \Carbon\Carbon::parse($attendance->check_in_time) : null;
                                @endphp
                                {{ $checkIn ? $checkIn->format('d-m-Y h:i A') : 'No Check-In' }}
                            </td>
                            
                            <td>
                                @php
                                    $checkOut = $attendance->check_out_time ? \Carbon\Carbon::parse($attendance->check_out_time) : null;
                                @endphp
                                {{ $checkOut ? $checkOut->format('d-m-Y h:i A') : 'No Check-Out' }}
                            </td>
                            
                            <td>{{ $attendance->total_checkins ?? 0 }}</td>
                            <td>{{ $attendance->total_checkouts ?? 0 }}</td>

                            <!-- Time Difference Calculation -->
                            <td>
                                @if ($attendance->check_in_time && $attendance->check_out_time)
                                    @php
                                        $checkIn = \Carbon\Carbon::parse($attendance->check_in_time);
                                        $checkOut = \Carbon\Carbon::parse($attendance->check_out_time);
                                        $duration = $checkOut->diff($checkIn);
                                    @endphp
                                    {{ $duration->format('%h hours %i minutes') }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endisset
    </div>
@endsection
