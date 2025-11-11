@extends('adminlte::page')

@section('title', 'Parking List Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking List Details</h3>
        <div>
            <a href="{{ route('parking_allotments.edit', $parkingAllotment->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('parking_allotments.index') }}" class="btn btn-sm btn-secondary ms-2">
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
                            value="{{ $parkingAllotment->userCategory->category_name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Area</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->area->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Location</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->location->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->building->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Parking Location Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->plocation->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Parking Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->plist->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Start Date</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->start_date }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>End Date</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->end_date }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingAllotment->status }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" readonly>{{ $parkingAllotment->remarks ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
