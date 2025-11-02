@extends('adminlte::page')

@section('title', 'View Parking')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Parking Details</h3>
        <div>
            <a href="{{ route('parking_lists.edit', $parkingList->id) }}" class="btn btn-sm btn-warning me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('parking_lists.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    {{-- Parking Name --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Parking Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->parking_name }}" readonly>
                    </div>

                    {{-- Level --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Level</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->level }}" readonly>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->status }}" readonly>
                    </div>

                    {{-- Alloted By --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Alloted By</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->alloted_by ?? '—' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
