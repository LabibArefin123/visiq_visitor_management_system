@extends('adminlte::page')

@section('title', 'Checked-In Employees')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Checked-In Employees</h1>
    </div>
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-hover text-nowrap">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>EmployeeID</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Check-In Date</th>
                            <th>Check-In Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->employee->emp_id ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('employees.index') }}"
                                        class="text-decoration-none fw-bold text-primary">
                                        {{ $attendance->employee->name ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>{{ $attendance->employee->department ?? 'N/A' }}</td>
                                <td>
                                    {{ $attendance->check_in_date ? \Carbon\Carbon::parse($attendance->check_in_date)->format('d M Y') : '-' }}
                                </td>
                                <td>
                                    {{ $attendance->check_in_time }}{{ $attendance->check_in_time ? '[' . \Carbon\Carbon::parse($attendance->check_in_time)->format('g:i A') . ']' : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No checked-in employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $attendances->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
