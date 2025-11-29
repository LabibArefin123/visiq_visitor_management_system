@extends('adminlte::page')

@section('title', 'Visitor Job Application Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Job Application Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitor_job_applications.edit', $visitorJobApplication->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_job_applications.index') }}"
                class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><strong>Application ID</strong></label>
                    <p class="form-control">{{ $visitorJobApplication->application_id }}</p>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Name</strong></label>
                    <p class="form-control">{{ $visitorJobApplication->name }}</p>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Phone</strong></label>
                    <p class="form-control">{{ $visitorJobApplication->phone ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Email</strong></label>
                    <p class="form-control">{{ $visitorJobApplication->email ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Position</strong></label>
                    <p class="form-control">{{ $visitorJobApplication->position }}</p>
                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Status</strong></label>

                    <p class="form-control">
                        {{ $visitorJobApplication->status }}</p>

                </div>
                <div class="col-md-6 form-group">
                    <label><strong>Application Date</strong></label>
                    <p class="form-control">
                        {{ \Carbon\Carbon::parse($visitorJobApplication->application_date)->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
