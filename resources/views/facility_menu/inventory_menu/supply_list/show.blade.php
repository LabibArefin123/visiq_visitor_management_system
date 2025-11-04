@extends('adminlte::page')

@section('title', 'View Supply Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Supply Item</h3>
        <div>
            <a href="{{ route('supply_lists.edit', $supplyList->id) }}" class="btn btn-sm btn-primary me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('supply_lists.index') }}" class="btn btn-sm btn-secondary">
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
                        <label><strong>Item Name</strong></label>
                        <input type="text" class="form-control" value="{{ $supplyList->item_name }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>Item Code</strong></label>
                        <input type="text" class="form-control" value="{{ $supplyList->item_code }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label><strong>Category</strong></label>
                        <input type="text" class="form-control" value="{{ $supplyList->category }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label><strong>Unit</strong></label>
                        <input type="text" class="form-control" value="{{ $supplyList->unit }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label><strong>Quantity</strong></label>
                        <input type="number" class="form-control" value="{{ $supplyList->quantity }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label><strong>Reorder Level</strong></label>
                        <input type="number" class="form-control" value="{{ $supplyList->reorder_level }}" readonly>
                    </div>
                    <div class="col-md-8 form-group">
                        <label><strong>Storage Location</strong></label>
                        <input type="text" class="form-control" value="{{ $supplyList->location }}" readonly>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label><strong>Remarks</strong></label>
                    <textarea rows="3" class="form-control" readonly>{{ $supplyList->remarks }}</textarea>
                </div>
            </div>
        </div>
    </div>
@stop
