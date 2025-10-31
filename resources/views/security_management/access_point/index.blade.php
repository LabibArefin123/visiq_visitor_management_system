@extends('adminlte::page')

@section('title', 'Access Points')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Access Points</h3>
        <a href="{{ route('access_points.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th class="text-center">Name</th>
                            <th class="text-center">Location</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accessPoints as $point)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $point->name }}</td>
                                <td class="text-center">{{ $point->location ?? '-' }}</td>
                                <td>{{ $point->description ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('access_points.show', $point->id) }}" class="btn btn-sm btn-primary">
                                        Show
                                    </a>
                                    <a href="{{ route('access_points.edit', $point->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('access_points.destroy', $point->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this access point?');">
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
                                <td colspan="5" class="text-center">No access points found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
