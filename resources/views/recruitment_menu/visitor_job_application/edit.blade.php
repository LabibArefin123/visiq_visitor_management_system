@extends('adminlte::page')

@section('title', 'Edit Visitor Job Application')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Visitor Job Application</h3>
        <a href="{{ route('visitor_job_applications.index') }}"
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
                <form action="{{ route('visitor_job_applications.update', $visitorJobApplication->id) }}" method="POST"
                    data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- Application ID --}}
                        <div class="col-md-6 form-group">
                            <label for="application_id"><strong>Application ID</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="application_id" id="application_id"
                                class="form-control @error('application_id') is-invalid @enderror"
                                value="{{ old('application_id', $visitorJobApplication->application_id) }}"
                                placeholder="Enter Application ID">
                            @error('application_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name"><strong>Applicant Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $visitorJobApplication->name) }}" placeholder="Enter applicant name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 form-group">
                            <label for="phone"><strong>Phone</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $visitorJobApplication->phone) }}" placeholder="Enter phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $visitorJobApplication->email) }}" placeholder="Enter email address">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Position --}}
                        <div class="col-md-6 form-group">
                            <label for="position"><strong>Position</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="position" id="position"
                                class="form-control @error('position') is-invalid @enderror"
                                value="{{ old('position', $visitorJobApplication->position) }}"
                                placeholder="Enter position applied">
                            @error('position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="pending"
                                    {{ old('status', $visitorJobApplication->status) == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="approved"
                                    {{ old('status', $visitorJobApplication->status) == 'approved' ? 'selected' : '' }}>
                                    Approved</option>
                                <option value="rejected"
                                    {{ old('status', $visitorJobApplication->status) == 'rejected' ? 'selected' : '' }}>
                                    Rejected</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Application Date --}}
                        <div class="col-md-6 form-group">
                            <label for="application_date"><strong>Application Date</strong></label>
                            <input type="date" name="application_date" id="application_date"
                                class="form-control @error('application_date') is-invalid @enderror"
                                value="{{ old('application_date', $visitorJobApplication->application_date->format('Y-m-d')) }}">
                            @error('application_date')
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
