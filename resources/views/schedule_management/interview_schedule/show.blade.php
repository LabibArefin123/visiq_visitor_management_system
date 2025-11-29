@extends('adminlte::page')

@section('title', 'Interview Schedule Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Interview Schedule Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('interview_schedules.edit', $interviewSchedule->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('interview_schedules.index') }}"
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
                    <label><strong>Candidate Name</strong></label>
                    <p class="form-control">{{ $interviewSchedule->candidate->name }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Interviewer</strong></label>
                    <p class="form-control">{{ $interviewSchedule->employee->name ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Position</strong></label>
                    <p class="form-control">{{ $interviewSchedule->position }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Status</strong></label>
                    <p class="form-control">
                        {{ $interviewSchedule->status }}
                    </p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Interview Date</strong></label>
                    <p class="form-control">
                        {{ $interviewSchedule->interview_date ? $interviewSchedule->interview_date->format('d M Y, h:i A') : 'N/A' }}
                    </p>
                </div>

                <div class="col-md-12 form-group">
                    <label><strong>Remarks</strong></label>
                    <p class="form-control">{{ $interviewSchedule->remarks ?? 'N/A' }}</p>
                </div>

            </div>
        </div>
    </div>
@stop
