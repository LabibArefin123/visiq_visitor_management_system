@extends('adminlte::page')

@section('title', 'View Pending Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Pending Visitor</h3>
        <a href="{{ route('pending_visitors.edit', $visitor->id) }}"
            class="btn btn-sm btn-primary d-flex align-items-center gap-2">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    {{-- Visitor ID --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Visitor ID</strong></label>
                        <p class="form-control">{{ $visitor->visitor_id ?? 'N/A' }}</p>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Name</strong></label>
                        <p class="form-control">{{ $visitor->name }}</p>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Phone</strong></label>
                        <p class="form-control">{{ $visitor->phone }}</p>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Email</strong></label>
                        <p class="form-control">{{ $visitor->email ?? 'N/A' }}</p>
                    </div>

                    {{-- National ID --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>National ID</strong></label>
                        <p class="form-control">{{ $visitor->national_id ?? 'N/A' }}</p>
                    </div>

                    {{-- Purpose --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Purpose</strong></label>
                        <p class="form-control">{{ $visitor->purpose }}</p>
                    </div>

                    {{-- Visit Date --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Visit Date</strong></label>
                        <p class="form-control">{{ $visitor->visit_date }}
                        </p>
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Date of Birth</strong></label>
                        <p class="form-control">
                            {{ $visitor->date_of_birth }}</p>
                    </div>

                    {{-- Age --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Age</strong></label>
                        <p class="form-control">{{ $visitor->date_of_birth ? $visitor->age : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
