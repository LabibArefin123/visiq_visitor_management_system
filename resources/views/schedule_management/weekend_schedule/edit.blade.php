@extends('adminlte::page')

@section('title', 'Edit Weekend Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Weekend Schedule</h3>
        <a href="{{ route('weekend_schedules.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('weekend_schedules.update', $weekendSchedule->id) }}" method="POST"
                    data-confirm="update">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="slot_name"><strong>Slot Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="slot_name" id="slot_name"
                                class="form-control @error('slot_name') is-invalid @enderror"
                                value="{{ old('slot_name', $weekendSchedule->slot_name) }}" placeholder="Enter slot name">
                            @error('slot_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Working Days</strong> <span class="text-danger">*</span></label><br>
                            @php
                                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                $selectedDays = $weekendSchedule->working_days ?? [];
                            @endphp
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($days as $day)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="working_days[]"
                                            value="{{ $day }}" id="{{ $day }}"
                                            {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('working_days')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="Active" {{ $weekendSchedule->status == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ $weekendSchedule->status == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
