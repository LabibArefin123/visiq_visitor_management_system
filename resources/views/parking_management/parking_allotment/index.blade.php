@extends('adminlte::page')

@section('title', 'Parking Allocation List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking Allocation List</h3>
        <a href="{{ route('parking_allotments.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Category</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Building</th>
                            <th>Parking Name</th>
                            <th class="text-center">Level</th>
                            <th>Alloted By</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parkingData as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['category'] }}</td>
                                <td>{{ $item['area'] }}</td>
                                <td>{{ $item['location'] }}</td>
                                <td>{{ $item['building'] }}</td>
                                <td>{{ $item['parking_name'] }}</td>
                                <td class="text-center">{{ $item['level'] }}</td>
                                <td>{{ $item['alloted_by'] }}</td>
                                <td>
                                    {{ $item['start_date'] ? \Carbon\Carbon::parse($item['start_date'])->format('d F Y') : '--:--' }}
                                </td>
                                <td>
                                    {{ $item['end_date'] ? \Carbon\Carbon::parse($item['end_date'])->format('d F Y') : '--:--' }}
                                </td>
                                <td>
                                    @if ($item['status'] === 'Occupied')
                                        <span class="badge bg-danger">Occupied</span>
                                    @else
                                        <span class="badge bg-success">Vacant</span>
                                    @endif
                                </td>
                                <td>{{ $item['remarks'] }}</td>
                                <td>
                                    @if ($item['source'] === 'allotment')
                                        <a href="{{ route('parking_allotments.show', $item['id']) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('parking_allotments.edit', $item['id']) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('parking_allotments.destroy', $item['id']) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="triggerDeleteModal('{{ route('parking_allotments.destroy', $item['id']) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No parking data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
