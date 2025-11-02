@extends('adminlte::page')

@section('title', 'Building List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Building List</h3>
        <a href="{{ route('building_lists.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-plus" viewBox="0 0 24 24">
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
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Building Category</th>
                            <th>Naval Area</th>
                            <th>Location</th>
                            <th>Level</th>
                            <th>Unit Per Level</th>
                            <th>Remarks</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buildingLists as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->name ?? 'N/A' }}</td>
                                <td>{{ $list->category->category_name ?? 'N/A' }}</td>
                                <td>{{ $list->area->name ?? 'N/A' }}</td>
                                <td>{{ $list->location->name ?? 'N/A' }}</td>
                                <td>{{ $list->level ?? '-' }}</td>
                                <td>{{ $list->unit_per_level ?? '-' }}</td>
                                <td>{{ $list->remarks ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('building_lists.show', $list->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('building_lists.edit', $list->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('building_lists.destroy', $list->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this building?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No buildings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
