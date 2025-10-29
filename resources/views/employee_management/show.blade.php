@extends('adminlte::page')

@section('title', 'View Employee Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Employee Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('employees.edit', $employee->id) }}"
                class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">

                    {{-- Employee ID --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Employee ID</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->emp_id }}" readonly>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Name</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->name }}" readonly>
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Department</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->department }}" readonly>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Phone</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->phone }}" readonly>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Email</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->email }}" readonly>
                    </div>

                    {{-- National ID --}}
                    <div class="col-md-6 form-group">
                        <label><strong>National ID</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->national_id }}" readonly>
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Date of Birth</strong></label>
                        <input type="date" class="form-control" value="{{ $employee->date_of_birth }}" readonly>
                    </div>

                    {{-- Age (Optional Display) --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Age</strong></label>
                        <input type="text" class="form-control" value="{{ $employee->age }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
