@extends('adminlte::page')

@section('title', 'View Shift Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Shift Schedule Details</h3>
        <div>
            <a href="{{ route('shift_guard_schedules.edit', $shift_guard_schedule->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('shift_guard_schedules.index') }}" class="btn btn-secondary btn-sm">
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
                        <label><strong>Shift Name:</strong></label>
                        <p class="form-control">{{ $shift_guard_schedule->shift_name }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Start Time:</strong></label>
                        <p class="form-control">{{ date('h:i A', strtotime($shift_guard_schedule->start_time)) }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>End Time:</strong></label>
                        <p class="form-control">{{ date('h:i A', strtotime($shift_guard_schedule->end_time)) }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status:</strong></label>
                        <span class="badge {{ $shift_guard_schedule->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $shift_guard_schedule->status }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
