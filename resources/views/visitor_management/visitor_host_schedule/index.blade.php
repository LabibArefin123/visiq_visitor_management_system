@extends('adminlte::page')

@section('title', 'Visitor Host Schedules')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Visitor Host Schedules</h1>
        <a href="{{ route('visitor_host_schedules.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Host Schedule
        </a>
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
                            <th>Visitor ID</th>
                            <th>Visitor Name</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Meeting Date & Time</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->visitor->visitor_id }}</td>
                                <td>{{ $schedule->visitor->name }}</td>
                                <td>{{ $schedule->employee->emp_id }}</td>
                                <td>{{ $schedule->employee->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->meeting_date)->format('d M, Y h:i A') }}</td>
                                <td>{{ ucfirst($schedule->status) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('visitor_host_schedules.show', $schedule->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('visitor_host_schedules.edit', $schedule->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('visitor_host_schedules.destroy', $schedule->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No host schedules found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $schedules->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
