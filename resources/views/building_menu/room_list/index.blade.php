@extends('adminlte::page')

@section('title', 'Room List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Room List</h3>
        <a href="{{ route('room_lists.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>#</th>
                            <th>Room Name</th>
                            <th>Room Name (in Bangla)</th>
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
                        @forelse ($rooms as $flat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $flat->room_name }}</td>
                                <td>{{ $flat->room_name_in_bangla }}</td>
                                <td>{{ $flat->category->category_name ?? 'N/A' }}</td>
                                <td>{{ $flat->area->name ?? 'N/A' }}</td>
                                <td>{{ $flat->location->name ?? 'N/A' }}</td>
                                <td>{{ $flat->building->name ?? 'N/A' }}</td>
                                <td>{{ $flat->level ?? '-' }}</td>
                                <td>{{ $flat->remarks }}</td>
                                <td>
                                    <a href="{{ route('room_lists.show', $flat->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('room_lists.edit', $flat->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('room_lists.destroy', $flat->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('room_lists.destroy', $flat->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No rooms found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $rooms->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
