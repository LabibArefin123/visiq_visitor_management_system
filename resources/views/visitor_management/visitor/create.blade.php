@extends('adminlte::page')

@section('title', 'Create Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Visitor</h3>
        <a href="{{ route('visitors.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('visitors.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label for="visitor_id"><strong>Visitor ID</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="visitor_id" id="visitor_id"
                                class="form-control @error('visitor_id') is-invalid @enderror"
                                value="{{ old('visitor_id') }}" placeholder="Enter Visitor ID">
                            @error('visitor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter visitor's name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="phone"><strong>Phone</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                placeholder="Enter phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="email"><strong>Email <span class="text-danger">*</span></strong></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter email address">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="purpose"><strong>Visit Purpose <span class="text-danger">*</span></strong></label>
                            <input type="text" name="purpose" id="purpose"
                                class="form-control @error('purpose') is-invalid @enderror" value="{{ old('purpose') }}"
                                placeholder="Enter visit purpose">
                            @error('purpose')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="visit_date"><strong>Visit Date <span class="text-danger">*</span></strong></label>
                            <input type="date" name="visit_date" id="visit_date"
                                class="form-control @error('visit_date') is-invalid @enderror"
                                value="{{ old('visit_date') }}">
                            @error('visit_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="date_of_birth"><strong>Date of Birth <span
                                        class="text-danger">*</span></strong></label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="national_id"><strong>National ID <span class="text-danger">*</span></strong></label>
                            <input type="text" name="national_id" id="national_id"
                                class="form-control @error('national_id') is-invalid @enderror"
                                value="{{ old('national_id') }}" placeholder="Enter National ID number">
                            @error('national_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group ">
                            <label for="gender"><strong>Gender <span class="text-danger">*</span></strong></label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
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
