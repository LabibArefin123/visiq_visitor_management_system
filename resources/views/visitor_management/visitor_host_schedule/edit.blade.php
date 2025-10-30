@extends('adminlte::page')

@section('title', 'Edit Visitor Host Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Visitor Host Schedule</h3>
        <a href="{{ route('visitor_host_schedules.index') }}"
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
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visitor_host_schedules.update', $visitor_host_schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Visitor Name</strong> <span class="text-danger">*</span></label>
                        <select name="visitor_id" class="form-control @error('visitor_id') is-invalid @enderror">
                            <option value="">Select Visitor</option>
                            @foreach ($visitors->groupBy('purpose') as $purpose => $groupedVisitors)
                                <optgroup label="{{ $purpose }}">
                                    @foreach ($groupedVisitors as $visitor)
                                        <option value="{{ $visitor->id }}"
                                            {{ $visitor_host_schedule->visitor_id == $visitor->id ? 'selected' : '' }}>
                                            {{ $visitor->name }} ({{ $visitor->visitor_id }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('visitor_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-md-6 form-group">
                        <label><strong>Employee Name</strong> <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ $visitor_host_schedule->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->emp_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Meeting Date & Time</strong> <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="meeting_date"
                            class="form-control @error('meeting_date') is-invalid @enderror"
                            value="{{ old('meeting_date', $visitor_host_schedule->meeting_date->format('Y-m-d\TH:i')) }}">
                        @error('meeting_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Purpose</strong></label>
                        <textarea name="purpose" class="form-control @error('purpose') is-invalid @enderror" placeholder="Enter purpose">{{ old('purpose', $visitor_host_schedule->purpose) }}</textarea>
                        @error('purpose')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong> <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="scheduled"
                                {{ $visitor_host_schedule->status == 'scheduled' ? 'selected' : '' }}>Scheduled
                            </option>
                            <option value="completed"
                                {{ $visitor_host_schedule->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled"
                                {{ $visitor_host_schedule->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@stop
