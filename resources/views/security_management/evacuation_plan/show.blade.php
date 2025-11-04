@extends('adminlte::page')

@section('title', 'View Evacuation Plan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Evacuation Plan</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('evacuation_plans.edit', $evacuationPlan->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('evacuation_plans.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    {{-- Plan Name --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Plan Name</strong></label>
                        <input type="text" class="form-control" value="{{ $evacuationPlan->plan_name }}" readonly>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Location</strong></label>
                        <input type="text" class="form-control" value="{{ $evacuationPlan->location }}" readonly>
                    </div>

                    {{-- Scheduled Date --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Scheduled Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $evacuationPlan->scheduled_date->format('d M, Y') }}" readonly>
                    </div>

                    {{-- Scheduled Time --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Scheduled Time</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $evacuationPlan->scheduled_time ? \Carbon\Carbon::parse($evacuationPlan->scheduled_time)->format('h:i A') : '-' }}"
                            readonly>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control"
                            value="{{ ucfirst(str_replace('_', ' ', $evacuationPlan->status)) }}" readonly>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 form-group mt-3">
                        <label><strong>Description</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $evacuationPlan->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
