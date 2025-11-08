@extends('adminlte::page')

@section('title', 'Sub Area List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Sub Area List</h3>
        <a href="{{ route('sub_areas.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
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
                            <th>SL</th>
                            <th>Area Name</th>
                            <th>Sub Area Name</th>
                            <th>Sub Area Name (in Bangla)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subAreas as $key => $subArea)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subArea->area->name ?? 'N/A' }}</td>
                                <td>{{ $subArea->sub_area_name }}</td>
                                <td>{{ $subArea->sub_area_name_in_bangla ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('sub_areas.show', $subArea->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('sub_areas.edit', $subArea->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('sub_areas.destroy', $subArea->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('sub_areas.destroy', $subArea->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Sub Areas found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
