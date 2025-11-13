@extends('adminlte::page')

@section('title', 'Add Visitor Emergency')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Create Visitor Emergency</h3>
        <a href="{{ route('visitor_emergencys.index') }}"
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
                <form action="{{ route('visitor_emergencys.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">

                        {{-- Emergency ID --}}
                        <div class="col-md-6 form-group">
                            <label for="emergency_id"><strong>Emergency ID</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="emergency_id" id="emergency_id"
                                class="form-control @error('emergency_id') is-invalid @enderror"
                                value="{{ old('emergency_id') }}" placeholder="Enter emergency ID">
                            @error('emergency_id')
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

                        {{-- Email --}}
                        <div class="col-md-6 form-group">
                            <label for="email"><strong>Email</strong> <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter visitor email">
                            @error('email')
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

                        {{-- Reason --}}
                        <div class="col-md-12 form-group">
                            <label for="reason"><strong>Reason for Emergency</strong> <span
                                    class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" rows="3" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Describe the emergency">{{ old('reason') }}</textarea>
                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Emergency DateTime --}}
                        <div class="col-md-6 form-group">
                            <label for="emergency_at"><strong>Emergency Date & Time</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="emergency_at" id="emergency_at"
                                class="form-control @error('emergency_at') is-invalid @enderror"
                                value="{{ old('emergency_at') }}">
                            @error('emergency_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
