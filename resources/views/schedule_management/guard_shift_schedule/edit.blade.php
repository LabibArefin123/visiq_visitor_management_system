@extends('adminlte::page')

@section('title', 'Edit Shift Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Guard Shift Schedule</h3>
        <a href="{{ route('shift_guard_schedules.index') }}"
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
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <form action="{{ route('shift_guard_schedules.update', $shift_guard_schedule->id) }}" method="POST"
                    data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="shift_name"><strong>Shift Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="shift_name" id="shift_name"
                                class="form-control @error('shift_name') is-invalid @enderror"
                                value="{{ old('shift_name', $shift_guard_schedule->shift_name) }}"
                                placeholder="Enter shift name">
                            @error('shift_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="start_time"><strong>Start Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time', $shift_guard_schedule->start_time) }}">
                            @error('start_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="end_time"><strong>End Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" id="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time', $shift_guard_schedule->end_time) }}">
                            @error('end_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Active" {{ $shift_guard_schedule->status == 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="Inactive"
                                    {{ $shift_guard_schedule->status == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
