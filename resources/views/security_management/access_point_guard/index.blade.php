@extends('adminlte::page')

@section('title', 'Access Point Guard Assignments')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Access Point Guard List</h3>
        <a href="{{ route('access_point_guards.create') }}" class="btn btn-success btn-sm">
            + Add New
        </a>
    </div>
@stop

@section('content')
   <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap text-center" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th class="text-center">Access Point</th>
                            <th class="text-center">Guard Name</th>
                            <th class="text-center">Shift Start</th>
                            <th class="text-center">Shift End</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignments as $assignment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $assignment->accessPoint->name }}</td>
                                <td class="text-center">{{ $assignment->guard_module->name }}</td>
                                <td class="text-center">
                                    {{ $assignment->shift_start ? \Carbon\Carbon::parse($assignment->shift_start)->format('h:i A') : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $assignment->shift_end ? \Carbon\Carbon::parse($assignment->shift_end)->format('h:i A') : '-' }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('access_point_guards.edit', $assignment->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <a href="{{ route('access_point_guards.show', $assignment->id) }}"
                                        class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <form action="{{ route('access_point_guards.destroy', $assignment->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No assignments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
