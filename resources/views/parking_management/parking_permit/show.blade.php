@extends('adminlte::page')

@section('title', 'Parking Permit Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking Permit Details</h3>
        <div>
            <a href="{{ route('parking_permits.edit', $parkingPermit->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('parking_permits.index') }}" class="btn btn-sm btn-secondary ms-2">
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
                            value="{{ $parkingPermit->userCategory->category_name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Visitor Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->visitor->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Area</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->area->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Location</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->location->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->building->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Parking Location Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->plocation->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Parking Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->plist->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Issued By</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $parkingPermit->issuedByEmployee->name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Issue Date</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->issue_date }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Expiry Date</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->expiry_date }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingPermit->status }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" readonly>{{ $parkingPermit->remarks ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
