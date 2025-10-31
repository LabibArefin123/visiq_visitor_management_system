@extends('adminlte::page')

@section('title', 'Edit Emergency Incident')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Emergency Incident</h3>
        <a href="{{ route('emergency_incidents.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-arrow-left" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('emergency_incidents.update', $emergency_incident->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><strong>Incident Type</strong></label>
                            <input type="text" name="incident_type"
                                value="{{ old('incident_type', $emergency_incident->incident_type) }}" class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="reported_by"><strong>Reported By</strong></label>
                            <select name="reported_by" id="reported_by"
                                class="form-control @error('reported_by') is-invalid @enderror">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->name }}"
                                        {{ old('reported_by', $emergency_incident->reported_by) == $employee->name ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('reported_by')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-md-6 form-group">
                            <label><strong>Location</strong></label>
                            <input type="text" name="location"
                                value="{{ old('location', $emergency_incident->location) }}" class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Incident Time</strong></label>
                            <input type="datetime-local" name="incident_time"
                                value="{{ old('incident_time', \Carbon\Carbon::parse($emergency_incident->incident_time)->format('Y-m-d\TH:i')) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-12 form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="description" rows="3" class="form-control">{{ old('description', $emergency_incident->description) }}</textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Status</strong></label>
                            <select name="status" class="form-control">
                                <option value="Pending" {{ $emergency_incident->status == 'Pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="In Progress"
                                    {{ $emergency_incident->status == 'In Progress' ? 'selected' : '' }}>In Progress
                                </option>
                                <option value="Resolved" {{ $emergency_incident->status == 'Resolved' ? 'selected' : '' }}>
                                    Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
