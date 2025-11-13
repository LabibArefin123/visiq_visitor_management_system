@extends('adminlte::page')

@section('title', 'Edit Visitor Group Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Visitor Group Schedule</h3>
        <a href="{{ route('visitor_group_schedules.index') }}"
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
            <form action="{{ route('visitor_group_schedules.update', $visitor_group_schedule->id) }}" method="POST" data-confirm="edit">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Visitor Group Name</strong> <span class="text-danger">*</span></label>
                        <select name="visitor_group_id"
                            class="form-control @error('visitor_group_id') is-invalid @enderror">
                            <option value="">Select Visitor</option>
                            @foreach ($gVisitors as $visitor)
                                <option value="{{ $visitor->id }}"
                                    {{ $visitor_group_schedule->visitor_group_id == $visitor->id ? 'selected' : '' }}>
                                    {{ $visitor->group_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('visitor_group_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-md-6 form-group">
                        <label><strong>Employee Name</strong> <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ $visitor_group_schedule->employee_id == $employee->id ? 'selected' : '' }}>
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
                            value="{{ old('meeting_date', $visitor_group_schedule->meeting_date->format('Y-m-d\TH:i')) }}">
                        @error('meeting_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Purpose</strong></label>
                        <textarea name="purpose" class="form-control @error('purpose') is-invalid @enderror" placeholder="Enter purpose">{{ old('purpose', $visitor_group_schedule->purpose) }}</textarea>
                        @error('purpose')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Status</strong> <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">Select Status
                            </option>
                            <option value="scheduled"
                                {{ $visitor_group_schedule->status == 'scheduled' ? 'selected' : '' }}>Scheduled
                            </option>
                            <option value="completed"
                                {{ $visitor_group_schedule->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled"
                                {{ $visitor_group_schedule->status == 'cancelled' ? 'selected' : '' }}>Cancelled
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
