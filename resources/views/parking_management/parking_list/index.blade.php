@extends('adminlte::page')

@section('title', 'Parking List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking List</h3>
        <a href="{{ route('parking_lists.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
    <div class="card shadow-lg mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>SL</th>
                        <th>Parking Name</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Alloted By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($parkingLists as $index => $parking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $parking->parking_name }}</td>
                            <td>{{ $parking->level }}</td>
                            <td>{{ $parking->status }}</td>
                            <td>{{ $parking->alloted_by ?? '—' }}</td>
                            <td>
                                <a href="{{ route('parking_lists.show', $parking->id) }}"
                                    class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('parking_lists.edit', $parking->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('parking_lists.destroy', $parking->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this parking?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Parking Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
