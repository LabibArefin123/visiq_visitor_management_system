@extends('adminlte::page')

@section('title', 'Parking List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking List</h3>
        <a href="{{ route('parking_lists.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th class="text-center">Parking Name</th>
                            <th class="text-center">Parking Name (in Bangla)</th>
                            <th>Category</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Building</th>
                            <th>Parking Location</th>
                            <th class="text-center">Level</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parkingLists as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $list->name }}</td>
                                <td class="text-center">{{ $list->name_in_bangla }}</td>
                                <td>{{ $list->userCategory->category_name ?? 'N/A' }}</td>
                                <td>{{ $list->area->name ?? 'N/A' }}</td>
                                <td>{{ $list->location->name ?? 'N/A' }}</td>
                                <td>{{ $list->building->name ?? 'N/A' }}</td>
                                <td>{{ $list->plocation->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $list->level ?? '-' }}</td>
                                <td>{{ $list->remarks }}</td>
                                <td>
                                    <a href="{{ route('parking_lists.show', $list->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('parking_lists.edit', $list->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('parking_lists.destroy', $list->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('parking_lists.destroy', $list->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No parking list found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
