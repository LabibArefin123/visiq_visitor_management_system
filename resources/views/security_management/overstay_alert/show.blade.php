@extends('adminlte::page')

@section('title', 'View Overstay Alert')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Overstay Alert Details</h3>
        <div>
            <a href="{{ route('overstay_alerts.edit', $overstayAlert->id) }}" class="btn btn-sm btn-primary me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('overstay_alerts.index') }}" class="btn btn-sm btn-secondary">
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
                    <div class="col-md-6 mb-3">
                        <label><strong>Visitor Name</strong></label>
                        <input type="text" class="form-control" value="{{ $overstayAlert->visitor_name }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Visit Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $overstayAlert->visit_date->format('d M, Y') }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Expected Checkout Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $overstayAlert->expected_checkout_date->format('d M, Y') }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Actual Checkout Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $overstayAlert->actual_checkout_date ? $overstayAlert->actual_checkout_date->format('d M, Y') : 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $overstayAlert->status }}" readonly>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $overstayAlert->remarks ?? 'No remarks provided.' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
