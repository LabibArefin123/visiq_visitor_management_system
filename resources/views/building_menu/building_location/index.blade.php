@extends('adminlte::page')

@section('title', 'Building Locations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Building Locations List</h3>
        <a href="{{ route('building_locations.create') }}" class="btn btn-sm btn-success">Add New</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th class="text-center">User Category</th>
                            <th>Name</th>
                            <th>Name in Bangla</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $location)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $location->userCategory->category_name ?? '-' }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->name_in_bangla ?? '-' }}</td>
                                <td class="text-center">{{ $location->area->name ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('building_locations.show', $location->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('building_locations.edit', $location->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('building_locations.destroy', $location->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('building_locations.destroy', $location->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No building locations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
