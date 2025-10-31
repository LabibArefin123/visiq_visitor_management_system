@extends('adminlte::page')

@section('title', 'Emergency Incident List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Emergency Incident List</h3>
        <a href="{{ route('emergency_incidents.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Incident Type</th>
                            <th>Reported By</th>
                            <th>Location</th>
                            <th>Incident Time</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incidents as $incident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $incident->incident_type }}</td>
                                <td>{{ $incident->reported_by }}</td>
                                <td>{{ $incident->location }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($incident->incident_time)->format('d M Y, h:i A') }}
                                    <span class="text-muted">
                                        ({{ \Carbon\Carbon::parse($incident->incident_time)->format('H:i') }})
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge 
                                        @if ($incident->status == 'Resolved') bg-success 
                                        @elseif($incident->status == 'In Progress') bg-warning 
                                        @else bg-danger @endif">
                                        {{ $incident->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('emergency_incidents.show', $incident->id) }}"
                                            class="btn btn-info btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('emergency_incidents.edit', $incident->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('emergency_incidents.destroy', $incident->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this incident?');">
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
                                <td colspan="7" class="text-center text-muted">No emergency incidents found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 px-3">
                    {{ $incidents->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
