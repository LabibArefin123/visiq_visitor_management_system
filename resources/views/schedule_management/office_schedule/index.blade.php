@extends('adminlte::page')

@section('title', 'Office Schedules')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Office Schedule List</h1>
        <a href="{{ route('office_schedules.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Organization</th>
                            <th>Schedule Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->organization->name }}</td>
                                <td>{{ $schedule->schedule_name }}</td>
                                <td>{{ $schedule->start_time }}</td>
                                <td>{{ $schedule->end_time }}</td>
                                <td>
                                    <span class="badge bg-{{ $schedule->status == 'Active' ? 'success' : 'danger' }}">
                                        {{ $schedule->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('office_schedules.show', $schedule->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('office_schedules.edit', $schedule->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('office_schedules.destroy', $schedule->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No office schedules found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $schedules->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
