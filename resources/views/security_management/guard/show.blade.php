@extends('adminlte::page')

@section('title', 'Guard Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Guard Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('guards.edit', $guard->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('guards.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    {{-- Guard ID --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Guard ID</strong></label>
                        <input type="text" class="form-control" value="{{ $guard->guard_id }}" readonly>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Name</strong></label>
                        <input type="text" class="form-control" value="{{ $guard->name }}" readonly>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Phone</strong></label>
                        <input type="text" class="form-control" value="{{ $guard->phone }}" readonly>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Email</strong></label>
                        <input type="text" class="form-control" value="{{ $guard->email ?? 'N/A' }}" readonly>
                    </div>

                    {{-- Shift --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Shift</strong></label>
                        <input type="text" class="form-control" value="{{ $guard->shift ?? 'N/A' }}" readonly>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Status</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $guard->status == 'Active' ? 'Active' : 'Inactive' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
