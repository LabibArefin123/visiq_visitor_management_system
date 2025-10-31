@extends('adminlte::page')

@section('title', 'View Emergency Incident')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Incident Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('emergency_incidents.edit', $emergency_incident->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('emergency_incidents.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Incident Type:</strong>
                        <p>{{ $emergency_incident->incident_type }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Reported By:</strong>
                        <p>{{ $emergency_incident->reported_by }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Location:</strong>
                        <p>{{ $emergency_incident->location }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Incident Time:</strong>
                        <p>{{ \Carbon\Carbon::parse($emergency_incident->incident_time)->format('d M Y, h:i A') }}</p>
                    </div>

                    <div class="col-md-12">
                        <strong>Description:</strong>
                        <p>{{ $emergency_incident->description }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <span
                            class="badge 
                            @if ($emergency_incident->status == 'Resolved') bg-success 
                            @elseif($emergency_incident->status == 'In Progress') bg-warning 
                            @else bg-danger @endif">
                            {{ $emergency_incident->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
