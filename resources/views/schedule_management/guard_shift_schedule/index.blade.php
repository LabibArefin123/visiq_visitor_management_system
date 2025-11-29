@extends('adminlte::page')

@section('title', 'Shift Schedule List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Guard Shift Schedule List</h3>
        <a href="{{ route('shift_guard_schedules.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Shift Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shiftSchedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->shift_name }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                    <span
                                        class="text-muted">({{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }})</span>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                    <span
                                        class="text-muted">({{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }})</span>
                                </td>

                                <td>
                                    <span class="badge {{ $schedule->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $schedule->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('shift_guard_schedules.show', $schedule->id) }}"
                                            class="btn btn-info btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('shift_guard_schedules.edit', $schedule->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('shift_guard_schedules.destroy', $schedule->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="triggerDeleteModal('{{ route('shift_guard_schedules.destroy', $schedule->id) }}')">
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
            </div>
        </div>
    </div>
@stop
