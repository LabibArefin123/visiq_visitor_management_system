@extends('adminlte::page')

@section('title', 'Create Emergency Incident')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Create Emergency Incident</h3>
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
                <form action="{{ route('emergency_incidents.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="incident_type"><strong>Incident Type</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="incident_type" id="incident_type"
                                class="form-control @error('incident_type') is-invalid @enderror"
                                value="{{ old('incident_type') }}" placeholder="e.g. Fire, Medical, Security Breach">
                            @error('incident_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="reported_by"><strong>Reported By</strong> <span class="text-danger">*</span></label>
                            <select name="reported_by" id="reported_by"
                                class="form-control @error('reported_by') is-invalid @enderror">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->name }}"
                                        {{ old('reported_by') == $employee->name ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('reported_by')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="location"><strong>Location</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}"
                                placeholder="Incident location">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="incident_time"><strong>Incident Time</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="incident_time" id="incident_time"
                                class="form-control @error('incident_time') is-invalid @enderror"
                                value="{{ old('incident_time') }}">
                            @error('incident_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="description"><strong>Description</strong> <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Describe what happened">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
