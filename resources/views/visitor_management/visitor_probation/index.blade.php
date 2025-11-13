@extends('adminlte::page')

@section('title', 'Visitor Probation List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Probation List</h3>
        <a href="{{ route('visitor_probations.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Probation ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>National ID</th>
                            <th>Status</th>
                            <th class="text-center">Probation Period</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($probations as $probation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $probation->probation_id }}</td>
                                <td>{{ $probation->name }}</td>
                                <td>{{ $probation->phone }}</td>
                                <td>{{ $probation->national_id ?? 'N/A' }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ strtolower($probation->status) == 'approved' ? 'success' : (strtolower($probation->status) == 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst(strtolower($probation->status)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $probation->probation_start ? \Carbon\Carbon::parse($probation->probation_start)->format('d M, Y') : 'N/A' }}
                                    -
                                    {{ $probation->probation_end ? \Carbon\Carbon::parse($probation->probation_end)->format('d M, Y') : 'N/A' }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('visitor_probations.show', $probation->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('visitor_probations.edit', $probation->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('visitor_probations.destroy', $probation->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('visitor_probations.destroy', $probation->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No visitor probation records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
