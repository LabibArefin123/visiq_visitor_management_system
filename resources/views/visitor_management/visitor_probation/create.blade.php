@extends('adminlte::page')

@section('title', 'Add Visitor Probation')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add Visitor on Probation</h3>
        <a href="{{ route('visitor_probations.index') }}"
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
                <form action="{{ route('visitor_probations.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">

                        {{-- Probation ID --}}
                        <div class="col-md-6 form-group">
                            <label for="probation_id"><strong>Probation ID</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="probation_id" id="probation_id"
                                class="form-control @error('probation_id') is-invalid @enderror"
                                value="{{ old('probation_id') }}" placeholder="Enter Probation ID">
                            @error('probation_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Visitor Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name"><strong>Visitor Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter visitor name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 form-group">
                            <label for="phone"><strong>Phone</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                placeholder="Enter phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- National ID --}}
                        <div class="col-md-6 form-group">
                            <label for="national_id"><strong>National ID</strong></label>
                            <input type="text" name="national_id" id="national_id"
                                class="form-control @error('national_id') is-invalid @enderror"
                                value="{{ old('national_id') }}" placeholder="Enter national ID number">
                            @error('national_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12 form-group">
                            <label for="reason"><strong>Reason for Probation</strong> <span
                                    class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" rows="3" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Enter reason for probation">{{ old('reason') }}</textarea>
                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Probation Start --}}
                        <div class="col-md-6 form-group">
                            <label for="probation_start"><strong>Probation Start Date</strong></label>
                            <input type="date" name="probation_start" id="probation_start"
                                class="form-control @error('probation_start') is-invalid @enderror"
                                value="{{ old('probation_start') }}">
                            @error('probation_start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Probation End --}}
                        <div class="col-md-6 form-group">
                            <label for="probation_end"><strong>Probation End Date</strong></label>
                            <input type="date" name="probation_end" id="probation_end"
                                class="form-control @error('probation_end') is-invalid @enderror"
                                value="{{ old('probation_end') }}">
                            @error('probation_end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
