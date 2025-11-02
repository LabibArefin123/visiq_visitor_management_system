@extends('adminlte::page')

@section('title', 'View Lost & Found Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Lost & Found Details</h3>
        <div>
            <a href="{{ route('lost_and_founds.edit', $lostAndFound->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('lost_and_founds.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Item Name</strong></label>
                        <input type="text" class="form-control" value="{{ $lostAndFound->item_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Reported By</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $lostAndFound->visitor->name ?? 'Unknown Visitor' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $lostAndFound->status }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Location</strong></label>
                        <input type="text" class="form-control" value="{{ $lostAndFound->location }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Reported Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($lostAndFound->reported_date)->format('d F, Y') }}" readonly>
                    </div>

                    <div class="col-md-12 form-group">
                        <label><strong>Description</strong></label>
                        <textarea class="form-control" readonly>{{ $lostAndFound->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
