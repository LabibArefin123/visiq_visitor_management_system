@extends('adminlte::page')

@section('title', 'Visitor Emergency List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Visitor Emergency List</h1>
        <a href="{{ route('visitor_emergencys.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover" id="dataTables">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Emergency ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Reason</th>
                        <th>Emergency At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emergencies as $emergency)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $emergency->emergency_id ?? 'N/A' }}</td>
                            <td>{{ $emergency->name }}</td>
                            <td>{{ $emergency->email ?? 'N/A' }}</td>
                            <td>{{ $emergency->phone }}</td>
                            <td>{{ Str::limit($emergency->reason, 40) }}</td>
                            <td>{{ \Carbon\Carbon::parse($emergency->emergency_at)->format('d M Y, h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('visitor_emergencys.show', $emergency->id) }}"
                                    class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('visitor_emergencys.edit', $emergency->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('visitor_emergencys.destroy', $emergency->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="triggerDeleteModal('{{ route('visitor_emergencys.destroy', $emergency->id) }}')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No emergency records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
