@extends('adminlte::page')

@section('title', 'Seat Allocations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Seat Allocations List</h3>
        <a href="{{ route('seat_allocations.create') }}" class="btn btn-success btn-sm d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
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
                            <th class="text-center">User Category</th>
                            <th class="text-center">Room</th>
                            <th class="text-center">Seat Number</th>
                            <th>People Name</th>
                            <th class="text-center">Allocation Date</th>
                            <th class="text-center">Remarks</th>
                            <th width="140" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allocations as $key => $allocation)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $allocation->userCategory->category_name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $allocation->room->room_name ?? 'N/A' }} (Level
                                    {{ $allocation->room->level ?? '-' }})</td>
                                <td class="text-center">{{ $allocation->seat_number }}</td>
                                <td>
                                    @if ($allocation->employee && $allocation->employee->name)
                                        {{ $allocation->employee->name }}
                                    @endif

                                    @if ($allocation->visitor && $allocation->visitor->name)
                                        @if ($allocation->employee)
                                            <br>
                                        @endif
                                        <small class="text-muted">{{ $allocation->visitor->name }}</small>
                                    @endif

                                    @if (!$allocation->employee && !$allocation->visitor)
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($allocation->allocation_date)->format('d M, Y') }}</td>
                                <td class="text-center">{{ $allocation->remarks ?? '—' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('seat_allocations.show', $allocation->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('seat_allocations.edit', $allocation->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('seat_allocations.destroy', $allocation->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('seat_allocations.destroy', $allocation->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">No seat allocations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
