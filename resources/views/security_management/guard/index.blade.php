@extends('adminlte::page')

@section('title', 'Guards')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Guard List</h1>
        <a href="{{ route('guards.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Guard ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Shift</th>
                            <th>Assigned Gate</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guards as $guard)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guard->guard_id }}</td>
                                <td>{{ $guard->name }}</td>
                                <td>{{ $guard->phone }}</td>
                                <td>{{ $guard->email ?? 'N/A' }}</td>
                                <td>{{ $guard->shift ?? 'N/A' }}</td>
                                <td>{{ $guard->assigned_gate ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $guard->status == 'Active' ? 'success' : 'danger' }}">
                                        {{ $guard->status }}
                                    </span>
                                </td>
                                <td>{{ $guard->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('guards.show', $guard->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('guards.edit', $guard->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('guards.destroy', $guard->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this guard?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No guards found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $guards->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
