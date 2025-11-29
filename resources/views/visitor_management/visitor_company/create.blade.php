@extends('adminlte::page')

@section('title', 'Add Visitor Company')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add Visitor Company</h3>
        <a href="{{ route('visitor_companies.index') }}"
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
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visitor_companies.store') }}" method="POST" data-confirm="create">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Company ID</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="company_id"
                            class="form-control @error('company_id') is-invalid @enderror" value="{{ old('company_id') }}"
                            placeholder="Enter company ID">
                        @error('company_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Company Name</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="company_name"
                            class="form-control @error('company_name') is-invalid @enderror"
                            value="{{ old('company_name') }}" placeholder="Enter company name">
                        @error('company_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Contact Person</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="contact_person"
                            class="form-control @error('contact_person') is-invalid @enderror"
                            value="{{ old('contact_person') }}" placeholder="Enter contact person">
                        @error('contact_person')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Email</strong> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Enter email address">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Phone</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}" placeholder="Enter phone number">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Address</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address') }}" placeholder="Enter company address">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>City</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                            value="{{ old('city') }}" placeholder="Enter city">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Country</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                            value="{{ old('country') }}" placeholder="Enter country">
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
