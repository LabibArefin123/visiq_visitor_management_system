@extends('adminlte::page')

@section('title', 'View Visitor Host Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Host Schedule Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitor_host_schedules.edit', $visitor_host_schedule->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_host_schedules.index') }}"
                class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-arrow-left"
                    viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><strong>Visitor ID</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_host_schedule->visitor->visitor_id }}"
                        readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Employee ID</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_host_schedule->employee->emp_id }}"
                        readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Visitor Name</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_host_schedule->visitor->name }}" readonly>
                </div>


                <div class="col-md-6 form-group">
                    <label><strong>Employee Name</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_host_schedule->employee->name }}"
                        readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Meeting Date & Time</strong></label>
                    <input type="text" class="form-control"
                        value="{{ \Carbon\Carbon::parse($visitor_host_schedule->meeting_date)->format('d M, Y h:i A') }}"
                        readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Purpose</strong></label>
                    <input type="text" class="form-control" readonly
                        value="{{ $visitor_host_schedule->purpose ?? '-' }}"></input>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Status</strong></label>
                    <input type="text" class="form-control" value="{{ ucfirst($visitor_host_schedule->status) }}"
                        readonly>
                </div>
            </div>

        </div>
    </div>
@stop
