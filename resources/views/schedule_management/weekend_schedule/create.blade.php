@extends('adminlte::page')

@section('title', 'Add Weekend Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Weekend Schedule</h3>
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

                <form action="{{ route('weekend_schedules.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        <!-- Slot Name -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="slot_name"><strong>Slot Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="slot_name" id="slot_name"
                                class="form-control @error('slot_name') is-invalid @enderror" value="{{ old('slot_name') }}"
                                placeholder="Enter slot name (e.g., Slot 1)">
                            @error('slot_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Working Days -->
                        <div class="col-md-12 form-group mb-3">
                            <label><strong>Working Days</strong> <span class="text-danger">*</span></label>
                            <div class="d-flex flex-wrap gap-3">
                                @php
                                    $days = [
                                        'Sunday',
                                        'Monday',
                                        'Tuesday',
                                        'Wednesday',
                                        'Thursday',
                                        'Friday',
                                        'Saturday',
                                    ];
                                @endphp
                                @foreach ($days as $day)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="working_days[]"
                                            value="{{ $day }}" id="day_{{ $day }}"
                                            {{ is_array(old('working_days')) && in_array($day, old('working_days')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day_{{ $day }}">
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('working_days')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
