@extends('adminlte::page')

@section('title', 'Weekend Schedule List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Weekend Schedule List</h3>
        <a href="{{ route('weekend_schedules.create') }}" class="btn btn-sm btn-success">Add New</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>Slot Name</th>
                            <th>Working Days</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($weekendSchedules as $key => $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->slot_name }}</td>
                                <td>
                                    @foreach (json_decode($schedule->working_days, true) ?? [] as $day)
                                        <span class="badge bg-info text-dark me-1">{{ $day }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $schedule->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $schedule->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('weekend_schedules.edit', $schedule->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('weekend_schedules.destroy', $schedule->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('weekend_schedules.destroy', $schedule->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Weekend Schedules Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
