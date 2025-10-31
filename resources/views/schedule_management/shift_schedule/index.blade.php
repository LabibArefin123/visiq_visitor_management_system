@extends('adminlte::page')

@section('title', 'Shift Schedule List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Shift Schedule List</h3>
        <a href="{{ route('shift_schedules.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Add New Shift
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Shift Name</th>
                            <th>Shift Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shiftSchedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->shift_name }}</td>
                                <td>{{ $schedule->shift_type }}</td>
                                <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                <td>
                                    <span class="badge {{ $schedule->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $schedule->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('shift_schedules.show', $schedule->id) }}"
                                            class="btn btn-info btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('shift_schedules.edit', $schedule->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('shift_schedules.destroy', $schedule->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure to delete this shift?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No shift schedules found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $shiftSchedules->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
