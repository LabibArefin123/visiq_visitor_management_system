@extends('adminlte::page')

@section('title', 'Area List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Area List</h3>
        <a href="{{ route('areas.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>SL</th>
                        <th class="text-center">Area Name</th>
                        <th class="text-center">Area Name (in Bangla)</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areas as $index => $area)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $area->name }}</td>
                            <td class="text-center">{{ $area->name_in_bangla }}</td>
                            <td class="text-center">
                                <a href="{{ route('areas.show', $area->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this area?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Area Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
