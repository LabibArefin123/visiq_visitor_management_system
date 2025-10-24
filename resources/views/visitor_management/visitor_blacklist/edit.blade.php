@extends('adminlte::page')

@section('title', 'Edit Blacklisted Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Blacklisted Visitor</h3>
        <a href="{{ route('visitor_blacklists.index') }}"
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
                <form action="{{ route('visitor_blacklists.update', $blacklistedVisitor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- Blacklist ID --}}
                        <div class="col-md-6 form-group">
                            <label for="blacklist_id"><strong>Blacklist ID</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="blacklist_id" id="blacklist_id"
                                class="form-control @error('blacklist_id') is-invalid @enderror"
                                value="{{ old('blacklist_id', $blacklistedVisitor->blacklist_id) }}"
                                placeholder="Enter Blacklist ID">
                            @error('blacklist_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $blacklistedVisitor->name) }}" placeholder="Enter visitor name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 form-group">
                            <label for="phone"><strong>Phone</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $blacklistedVisitor->phone) }}" placeholder="Enter phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- National ID --}}
                        <div class="col-md-6 form-group">
                            <label for="national_id"><strong>National ID</strong></label>
                            <input type="text" name="national_id" id="national_id"
                                class="form-control @error('national_id') is-invalid @enderror"
                                value="{{ old('national_id', $blacklistedVisitor->national_id) }}"
                                placeholder="Enter national ID number">
                            @error('national_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12 form-group">
                            <label for="reason"><strong>Reason for Blacklisting</strong> <span
                                    class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" rows="3" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Enter reason for blacklisting">{{ old('reason', $blacklistedVisitor->reason) }}</textarea>
                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="blacklisted_at"><strong>Blacklisted Date</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="blacklisted_at" id="blacklisted_at"
                                class="form-control @error('blacklisted_at') is-invalid @enderror"
                                value="{{ old('blacklisted_at', optional($blacklistedVisitor->blacklisted_at)->format('Y-m-d')) }}">
                            @error('blacklisted_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if ($blacklistedVisitor->blacklisted_at)
                                <small class="text-muted">
                                    Current:
                                    {{ \Carbon\Carbon::parse($blacklistedVisitor->blacklisted_at)->format('d M Y') }}
                                </small>
                            @endif
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
