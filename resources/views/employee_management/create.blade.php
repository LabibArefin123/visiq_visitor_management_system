@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Create Employee</h3>
        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
            <form action="{{ route('employees.store') }}" method="POST" data-confirm="create">
                @csrf
                <div class="row">

                    {{-- Employee ID --}}
                    <div class="col-md-6 form-group">
                        <label for="emp_id"><strong>Employee ID</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="emp_id" id="emp_id"
                            class="form-control @error('emp_id') is-invalid @enderror" value="{{ old('emp_id') }}"
                            placeholder="Enter Employee ID">
                        @error('emp_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6 form-group">
                        <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Enter employee name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6 form-group">
                        <label for="department"><strong>Department</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="department" id="department"
                            class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}"
                            placeholder="Enter department name">
                        @error('department')
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

                    {{-- Email --}}
                    <div class="col-md-6 form-group">
                        <label for="email"><strong>Email</strong> <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="Enter email address">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- National ID --}}
                    <div class="col-md-6 form-group">
                        <label for="national_id"><strong>National ID</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="national_id" id="national_id"
                            class="form-control @error('national_id') is-invalid @enderror"
                            value="{{ old('national_id') }}" placeholder="Enter National ID">
                        @error('national_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6 form-group">
                        <label for="date_of_birth"><strong>Date of Birth</strong> <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            class="form-control @error('date_of_birth') is-invalid @enderror"
                            value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
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
@stop
