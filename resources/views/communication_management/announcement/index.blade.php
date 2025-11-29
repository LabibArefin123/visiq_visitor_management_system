{{-- resources/views/communication_management/announcement/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Announcement List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Announcement List</h3>
        <a href="{{ route('announcements.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Title</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $announcement->title }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($announcement->start_date)->format('d F, Y') }}</td>
                                <td class="text-center">
                                    {{ $announcement->end_date ? \Carbon\Carbon::parse($announcement->end_date)->format('d F, Y') : 'N/A' }}
                                </td>

                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $announcement->status == 'Active' ? 'success' : 'secondary' }}">{{ $announcement->status }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('announcements.show', $announcement->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('announcements.edit', $announcement->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('announcements.destroy', $announcement->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No announcements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
