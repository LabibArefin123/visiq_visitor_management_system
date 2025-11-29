@extends('adminlte::page')

@section('title', 'View Weekend Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Weekend Schedule</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('weekend_schedules.edit', $weekendSchedule->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('weekend_schedules.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                        <label for="slot_name"><strong>Slot Name</strong></label>
                        <input type="text" readonly class="form-control" value="{{ $weekendSchedule->slot_name }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Working Days</strong></label>
                        <div class="border rounded p-2 bg-light">
                            @foreach ($weekendSchedule->working_days as $day)
                                <span class="badge bg-info text-dark me-1">{{ $day }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Status</strong></label>
                        <input type="text" readonly class="form-control" value="{{ $weekendSchedule->status }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
