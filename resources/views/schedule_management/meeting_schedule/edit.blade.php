@extends('adminlte::page')

@section('title', 'Edit Meeting Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Meeting Schedule</h3>
        <a href="{{ route('meeting_schedules.index') }}"
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
                <form action="{{ route('meeting_schedules.update', $meetingSchedule->id) }}" method="POST"
                    data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Schedule Name --}}
                        <div class="col-md-6 form-group">
                            <label for="title"><strong>Title</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ $meetingSchedule->title }}" placeholder="Enter schedule name">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Start Time --}}
                        <div class="col-md-6 form-group">
                            <label for="start_time"><strong>Start Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ $meetingSchedule->start_time }}">
                            @error('start_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- End Time --}}
                        <div class="col-md-6 form-group">
                            <label for="end_time"><strong>End Time</strong> <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" id="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ $meetingSchedule->end_time }}">
                            @error('end_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="Active" {{ $meetingSchedule->status == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ $meetingSchedule->status == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="meeting_type"><strong>Meeting Type</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="meeting_type" id="meeting_type"
                                class="form-control @error('meeting_type') is-invalid @enderror">
                                <option value="Single" {{ $meetingSchedule->meeting_type == 'Single' ? 'selected' : '' }}>
                                    Single
                                </option>
                                <option value="Group" {{ $meetingSchedule->meeting_type == 'Group' ? 'selected' : '' }}>
                                    Group</option>
                            </select>
                            @error('meeting_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="Active" {{ $meetingSchedule->status == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ $meetingSchedule->status == 'Inactive' ? 'selected' : '' }}>
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
