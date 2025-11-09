@extends('adminlte::page')

@section('title', 'Add Evacuation Plan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Evacuation Plan</h3>
        <a href="{{ route('evacuation_plans.index') }}"
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
                <form action="{{ route('evacuation_plans.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        {{-- Plan Name --}}
                        <div class="col-md-6 form-group">
                            <label for="plan_name"><strong>Plan Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="plan_name" id="plan_name"
                                class="form-control @error('plan_name') is-invalid @enderror" value="{{ old('plan_name') }}"
                                placeholder="Enter evacuation plan name">
                            @error('plan_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-6 form-group">
                            <label for="location"><strong>Location</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}"
                                placeholder="Enter location">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Scheduled Date --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="scheduled_date"><strong>Scheduled Date</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="scheduled_date" id="scheduled_date"
                                class="form-control @error('scheduled_date') is-invalid @enderror"
                                value="{{ old('scheduled_date') }}">
                            @error('scheduled_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Scheduled Time --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="scheduled_time"><strong>Scheduled Time</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="time" name="scheduled_time" id="scheduled_time"
                                class="form-control @error('scheduled_time') is-invalid @enderror"
                                value="{{ old('scheduled_time') }}">
                            @error('scheduled_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 form-group mt-3">
                            <label for="description"><strong>Description</strong></label>
                            <textarea name="description" id="description" rows="3" class="form-control" placeholder="Enter description">{{ old('description') }}</textarea>
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
