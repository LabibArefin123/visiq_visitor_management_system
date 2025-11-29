@extends('adminlte::page')

@section('title', 'View Access Point Guard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Assignment</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('access_point_guards.edit', $accessPointGuard->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('access_point_guards.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <div class="row">

                    {{-- Access Point --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Access Point:</strong></label>
                        <p class="form-control">{{ $accessPointGuard->accessPoint->name }}</p>
                    </div>

                    {{-- Guard --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Guard:</strong></label>
                        <p class="form-control">{{ $accessPointGuard->guard_module->name }}</p>
                    </div>

                    {{-- Shift Start --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Shift Start:</strong></label>
                        <p class="form-control">{{ $accessPointGuard->shift_start ?? '-' }}</p>
                    </div>

                    {{-- Shift End --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Shift End:</strong></label>
                        <p class="form-control">{{ $accessPointGuard->shift_end ?? '-' }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
