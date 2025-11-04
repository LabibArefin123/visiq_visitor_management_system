@extends('adminlte::page')

@section('title', 'Stock Log Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Stock Log Details</h3>
        <div>
            <a href="{{ route('stock_logs.edit', $stock_log->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('stock_logs.index') }}" class="btn btn-sm btn-secondary">Back</a>
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
                        <input type="text" class="form-control" value="{{ $stock_log->supplyList->item_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Log Type</strong></label>
                        <input type="text" class="form-control"
                            value="{{ ucfirst(str_replace('_', ' ', $stock_log->log_type)) }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Quantity</strong></label>
                        <input type="number" class="form-control" value="{{ $stock_log->quantity }}" readonly>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label><strong>Recorded By</strong></label>
                        <input type="text" class="form-control" value="{{ $stock_log->recorded_by }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Log Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($stock_log->log_date)->format('d M, Y') }}" readonly>
                    </div>


                    <div class="col-md-12 form-group ">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $stock_log->remarks }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
