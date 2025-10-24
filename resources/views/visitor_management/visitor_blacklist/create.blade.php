@extends('adminlte::page')

@section('title', 'Add Blacklisted Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Create Visitor</h3>
        <a href="{{ route('visitor_blacklists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                <form action="{{ route('visitor_blacklists.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        {{-- Blacklist ID --}}
                        <div class="col-md-6 form-group">
                            <label for="B_id"><strong>Blacklist ID</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="B_id" id="B_id"
                                class="form-control @error('B_id') is-invalid @enderror" value="{{ old('B_id') }}"
                                placeholder="Enter Blacklist ID">
                            @error('B_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
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
                            <label for="reason"><strong>Reason for Blacklisting</strong> <span
                                    class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" rows="3" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Enter reason for blacklisting">{{ old('reason') }}</textarea>
                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="col-md-6 form-group">
                            <label for="blacklisted_at"><strong>Blacklisted Date</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="blacklisted_at" id="blacklisted_at"
                                class="form-control @error('blacklisted_at') is-invalid @enderror"
                                value="{{ old('blacklisted_at') }}">
                            @error('blacklisted_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Blacklist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
