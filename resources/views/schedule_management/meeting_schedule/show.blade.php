@extends('adminlte::page')

@section('title', 'Meeting Schedule Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Meeting Schedule Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('meeting_schedules.edit', $meetingSchedule->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('meeting_schedules.index') }}" class="btn btn-sm btn-secondary">
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
                        <label><strong>Office Schedule</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->officeSchedule->name }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Meeting Title</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->title }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Meeting Date</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->meeting_date }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Start Time</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->start_time }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>End Time</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->end_time }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Meeting Type</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->meeting_type }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $meetingSchedule->status }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
