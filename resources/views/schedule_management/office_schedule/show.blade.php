@extends('adminlte::page')

@section('title', 'Office Schedule Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Office Schedule Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('office_schedules.edit', $office_schedule->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('office_schedules.index') }}" class="btn btn-sm btn-secondary">
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

                    <div class="col-md-6 form-group">
                        <label><strong>Organization</strong></label>
                        <input type="text" class="form-control" value="{{ $office_schedule->organization->name }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Schedule Name</strong></label>
                        <input type="text" class="form-control" value="{{ $office_schedule->schedule_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Start Time</strong></label>
                        <input type="text" class="form-control" value="{{ $office_schedule->start_time }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>End Time</strong></label>
                        <input type="text" class="form-control" value="{{ $office_schedule->end_time }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $office_schedule->status }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
