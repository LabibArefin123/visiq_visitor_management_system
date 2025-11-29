@extends('adminlte::page')

@section('title', 'Visitor Probation Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Probation Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitor_blacklists.edit', $visitorProbation->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_blacklists.index') }}"
                class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><strong>Probation ID</strong></label>
                    <p class="form-control">{{ $visitorProbation->probation_id }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Name</strong></label>
                    <p class="form-control">{{ $visitorProbation->name }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Phone</strong></label>
                    <p class="form-control">{{ $visitorProbation->phone ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Reason</strong></label>
                    <p class="form-control">{{ $visitorProbation->reason ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Status</strong></label>
                    <p class="form-control">{{ $visitorProbation->status ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>National ID</strong></label>
                    <p class="form-control">{{ $visitorProbation->national_id ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Probation Start</strong></label>
                    <p class="form-control">
                        {{ \Carbon\Carbon::parse($visitorProbation->probation_start)->format('d M Y, h:i A') }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Probation End</strong></label>
                    <p class="form-control">
                        {{ \Carbon\Carbon::parse($visitorProbation->probation_end)->format('d M Y, h:i A') }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
