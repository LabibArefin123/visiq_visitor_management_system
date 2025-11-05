@extends('adminlte::page')

@section('title', 'View Seat Allocation')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Seat Allocation Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('seat_allocations.edit', $seatAllocation->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('seat_allocations.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>User Category</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $seatAllocation->userCategory->category_name ?? 'N/A' }}" disabled>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Room</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $seatAllocation->room->room_name ?? 'N/A' }}{{ $seatAllocation->room ? ' (Level ' . $seatAllocation->room->level . ')' : '' }}"
                            disabled>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Seat Number</strong></label>
                        <input type="text" class="form-control" value="{{ $seatAllocation->seat_number }}" disabled>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Allocated To</strong></label>
                        <input type="text" class="form-control"
                            value="
                                @if ($seatAllocation->employee) Employee - {{ $seatAllocation->employee->emp_name }} ({{ $seatAllocation->employee->emp_id }})
                                @elseif($seatAllocation->visitor)
                                    Visitor - {{ $seatAllocation->visitor->visitor_name }}
                                @else
                                    N/A @endif
                            "
                            disabled>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Allocation Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($seatAllocation->allocation_date)->format('d M, Y') }}"
                            disabled>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <input type="text" class="form-control" value="{{ $seatAllocation->remarks ?? 'N/A' }}"
                            disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
