@extends('adminlte::page')

@section('title', 'Medical Emergency Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Medical Emergency Details</h3>
        <div>
            <a href="{{ route('medical_emergencies.index') }}" class="btn btn-sm btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('medical_emergencies.edit', $medicalEmergency->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    {{-- Incident Type --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Incident Type</strong></label>
                        <input type="text" class="form-control" value="{{ $medicalEmergency->incident_type }}" readonly>
                    </div>

                    {{-- Reporter Type --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Reported By Type</strong></label>
                        <input type="text" class="form-control"
                            value="{{ ucfirst($medicalEmergency->reported_by_type) }}" readonly>
                    </div>

                    {{-- Reporter Name --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Reporter</strong></label>
                        <input type="text" class="form-control" value="{{ $medicalEmergency->reporter->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Location</strong></label>
                        <input type="text" class="form-control" value="{{ $medicalEmergency->location }}" readonly>
                    </div>

                    {{-- Incident Time --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Incident Time</strong></label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($medicalEmergency->incident_time)->format('d M, Y, h:i A') }}"
                            readonly>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 form-group mt-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control" value="{{ $medicalEmergency->status }}" readonly>
                    </div>

                    {{-- Remarks --}}
                    <div class="col-md-12 form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $medicalEmergency->remarks }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
