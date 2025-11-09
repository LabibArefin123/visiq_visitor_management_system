@extends('adminlte::page')

@section('title', 'View Access Point')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Access Point</h3>
        <a href="{{ route('access_points.index') }}"
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
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Name:</strong></label>
                        <p>{{ $accessPoint->name }}</p>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Location:</strong></label>
                        <p>{{ $accessPoint->location ?? '-' }}</p>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Description:</strong></label>
                        <p>{{ $accessPoint->description ?? '-' }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
