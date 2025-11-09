@extends('adminlte::page')

@section('title', 'Parking Location List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking Location List</h3>
        <a href="{{ route('parking_locations.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Location Name</th>
                            <th>Location Name (in Bangla)</th>
                            <th>Category</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Building</th>
                            <th>Level</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parkingLocations as $location)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->name_in_bangla }}</td>
                                <td>{{ $location->userCategory->category_name ?? 'N/A' }}</td>
                                <td>{{ $location->area->name ?? 'N/A' }}</td>
                                <td>{{ $location->location->name ?? 'N/A' }}</td>
                                <td>{{ $location->building->name ?? 'N/A' }}</td>
                                <td>{{ $location->level ?? '-' }}</td>
                                <td>{{ $location->remarks }}</td>
                                <td>
                                    <a href="{{ route('parking_locations.show', $location->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('parking_locations.edit', $location->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('parking_locations.destroy', $location->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('parking_locations.destroy', $location->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No parking location found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
