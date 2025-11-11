@extends('adminlte::page')

@section('title', 'Parking Permit List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking Permit List</h3>
        <a href="{{ route('parking_permits.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
        <div class="card shadow-sm border-0">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap align-middle" id="dataTables">
                    <thead class="bg-dark text-white">
                        <tr class="{{ $item['row_class'] ?? '' }}">

                            <th>#</th>
                            <th>Visitor / Employee</th>
                            <th>Category</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Building</th>
                            <th>Parking Name</th>
                            <th class="text-center">Level</th>
                            <th>Issued By</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($parkingData as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if (!empty($item['visitor']))
                                        {{ $item['visitor'] }}
                                    @elseif (!empty($item['employee']))
                                        {{ $item['employee'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item['category'] ?? 'N/A' }}</td>
                                <td>{{ $item['area'] ?? 'N/A' }}</td>
                                <td>{{ $item['location'] ?? 'N/A' }}</td>
                                <td>{{ $item['building'] ?? 'N/A' }}</td>
                                <td>{{ $item['parking_name'] ?? 'N/A' }}</td>
                                <td class="text-center">{{ $item['level'] ?? '--' }}</td>
                                <td>{{ $item['issued_by'] ?? '--' }}</td>
                                <td>
                                    {{ $item['issue_date'] ? \Carbon\Carbon::parse($item['issue_date'])->format('d M Y') : '--:--' }}
                                </td>
                                <td>
                                    {{ $item['expiry_date'] ? \Carbon\Carbon::parse($item['expiry_date'])->format('d M Y') : '--:--' }}
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($item['status'] ?? '');
                                    @endphp
                                    @if ($status === 'active')
                                        <span class="badge badge-success px-2 py-1">Active</span>
                                    @elseif ($status === 'occupied')
                                        <span class="badge badge-danger px-2 py-1">Occupied</span>
                                    @elseif ($status === 'occupied')
                                        <span class="badge badge-warning px-2 py-1">Pending</span>
                                    @else
                                        <span class="badge badge-secondary px-2 py-1">{{ $item['status'] ?? 'N/A' }}</span>
                                    @endif
                                </td>
                                <td>{{ $item['remarks'] ?? '--' }}</td>
                                <td>
                                    <a href="{{ route('parking_permits.show', $item['id']) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('parking_permits.edit', $item['id']) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('parking_permits.destroy', $item['id']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="triggerDeleteModal('{{ route('parking_permits.destroy', $item['id']) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="text-center text-muted py-3">No parking permit data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
