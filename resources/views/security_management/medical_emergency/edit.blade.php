@extends('adminlte::page')

@section('title', 'Edit Medical Emergency')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Medical Emergency</h3>
        <a href="{{ route('medical_emergencies.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
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
                <form action="{{ route('medical_emergencies.update', $medicalEmergency->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Incident Type --}}
                        <div class="col-md-6 form-group">
                            <label for="incident_type"><strong>Incident Type</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="incident_type" id="incident_type"
                                class="form-control @error('incident_type') is-invalid @enderror"
                                value="{{ old('incident_type', $medicalEmergency->incident_type) }}"
                                placeholder="Enter incident type">
                            @error('incident_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reporter Type --}}
                        <div class="col-md-6 form-group">
                            <label for="reported_by_type"><strong>Reported By Type</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="reported_by_type" id="reported_by_type"
                                class="form-control @error('reported_by_type') is-invalid @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="employee"
                                    {{ old('reported_by_type', $medicalEmergency->reported_by_type) == 'employee' ? 'selected' : '' }}>
                                    Employee</option>
                                <option value="visitor"
                                    {{ old('reported_by_type', $medicalEmergency->reported_by_type) == 'visitor' ? 'selected' : '' }}>
                                    Visitor</option>
                                <option value="guard"
                                    {{ old('reported_by_type', $medicalEmergency->reported_by_type) == 'guard' ? 'selected' : '' }}>
                                    Guard</option>
                            </select>
                            @error('reported_by_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reporter Name (dynamic) --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="reported_by_id"><strong>Reporter</strong> <span class="text-danger">*</span></label>
                            <select name="reported_by_id" id="reported_by_id"
                                class="form-control @error('reported_by_id') is-invalid @enderror">
                                <option value="">-- Select Reporter --</option>
                            </select>
                            @error('reported_by_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="location"><strong>Location</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $medicalEmergency->location) }}" placeholder="Enter location">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Incident Time --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="incident_time"><strong>Incident Time</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="incident_time" id="incident_time"
                                class="form-control @error('incident_time') is-invalid @enderror"
                                value="{{ old('incident_time', \Carbon\Carbon::parse($medicalEmergency->incident_time)->format('Y-m-d\TH:i')) }}">
                            @error('incident_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status
                                </option>
                                <option value="Pending"
                                    {{ old('status', $medicalEmergency->status) == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="In Progress"
                                    {{ old('status', $medicalEmergency->status) == 'In Progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="Resolved"
                                    {{ old('status', $medicalEmergency->status) == 'Resolved' ? 'selected' : '' }}>Resolved
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group mt-3">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control" placeholder="Enter remarks">{{ old('remarks', $medicalEmergency->remarks) }}</textarea>
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

@section('js')
    <script>
        let reporterData = [];

        function loadReporters(type, selectedId = null) {
            const reporterSelect = document.getElementById('reported_by_id');
            reporterSelect.innerHTML = '<option value="">Loading...</option>';

            if (type) {
                fetch(`/get-reporters/${type}`)
                    .then(res => res.json())
                    .then(data => {
                        reporterData = data;
                        reporterSelect.innerHTML = '<option value="">-- Select Reporter --</option>';
                        data.forEach(item => {
                            reporterSelect.innerHTML +=
                                `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.name}</option>`;
                        });
                    })
                    .catch(() => {
                        reporterSelect.innerHTML = '<option value="">Error loading data</option>';
                    });
            } else {
                reporterSelect.innerHTML = '<option value="">-- Select Reporter --</option>';
            }
        }

        // On page load, pre-fill reporter dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const type = '{{ old('reported_by_type', $medicalEmergency->reported_by_type) }}';
            const selectedId = '{{ old('reported_by_id', $medicalEmergency->reported_by_id) }}';
            if (type) loadReporters(type, selectedId);
        });

        // When reporter type changes
        document.getElementById('reported_by_type').addEventListener('change', function() {
            loadReporters(this.value);
        });
    </script>
@stop
