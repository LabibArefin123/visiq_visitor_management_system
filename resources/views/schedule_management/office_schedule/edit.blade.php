@extends('adminlte::page')

@section('title', 'Edit Office Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Office Schedule</h3>
        <a href="{{ route('office_schedules.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('office_schedules.update', $office_schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- Organization --}}
                        <div class="col-md-6 form-group">
                            <label for="organization_id"><strong>Organization</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="organization_id" id="organization_id"
                                class="form-control @error('organization_id') is-invalid @enderror">
                                <option value="">Select Organization</option>
                                @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}"
                                        {{ $office_schedule->organization_id == $org->id ? 'selected' : '' }}>
                                        {{ $org->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('organization_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Schedule Name --}}
                        <div class="col-md-6 form-group">
                            <label for="schedule_name"><strong>Schedule Name</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="schedule_name" id="schedule_name"
                                class="form-control @error('schedule_name') is-invalid @enderror"
                                value="{{ $office_schedule->schedule_name }}" placeholder="Enter schedule name">
                            @error('schedule_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Start Time --}}
                        <div class="col-md-6 form-group">
                            <label for="start_time"><strong>Start Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ $office_schedule->start_time }}">
                            @error('start_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- End Time --}}
                        <div class="col-md-6 form-group">
                            <label for="end_time"><strong>End Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" id="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ $office_schedule->end_time }}">
                            @error('end_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="Active" {{ $office_schedule->status == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ $office_schedule->status == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
