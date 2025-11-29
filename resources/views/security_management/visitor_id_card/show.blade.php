@extends('adminlte::page')

@section('title', 'Visitor ID Card Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor ID Card Details</h3>
        <div>
            <a href="{{ route('visitor_id_cards.index') }}" class="btn btn-sm btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('visitor_id_cards.edit', $visitorIdCard->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
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
                        <label><strong>Card Number</strong></label>
                        <input type="text" class="form-control" value="{{ $visitorIdCard->card_number }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Holder Type</strong></label>
                        <input type="text" class="form-control" value="{{ ucfirst($visitorIdCard->holder_type) }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Card Holder</strong></label>
                        <input type="text" class="form-control" value="{{ $visitorIdCard->holder?->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Issue Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $visitorIdCard->issue_date ? \Carbon\Carbon::parse($visitorIdCard->issue_date)->format('d M, Y') : 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Expiry Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $visitorIdCard->expiry_date ? \Carbon\Carbon::parse($visitorIdCard->expiry_date)->format('d M, Y') : 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control text-capitalize" value="{{ $visitorIdCard->status }}"
                            readonly>
                    </div>

                    <div class="col-md-12 form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $visitorIdCard->remarks ?? 'No remarks' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
