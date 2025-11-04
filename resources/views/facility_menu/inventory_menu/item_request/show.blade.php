@extends('adminlte::page')

@section('title', 'View Item Request')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Item Request Details</h3>
        <div>
            <a href="{{ route('item_requests.edit', $itemRequest->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('item_requests.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Supply Item</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $itemRequest->supplyList->item_name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Requester Name</strong></label>
                        <input type="text" class="form-control" value="{{ $itemRequest->requester_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Department</strong></label>
                        <input type="text" class="form-control" value="{{ $itemRequest->department }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Request Type</strong></label>
                        <input type="text" class="form-control" value="{{ $itemRequest->request_type }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Quantity</strong></label>
                        <input type="text" class="form-control" value="{{ $itemRequest->quantity }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ ucfirst($itemRequest->status) }}" readonly>
                    </div>

                    <div class="col-md-12 form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $itemRequest->remarks }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
