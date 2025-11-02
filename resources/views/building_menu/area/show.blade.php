@extends('adminlte::page')

@section('title', 'View Area')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">View Area</h3>
        <div>
            <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-sm btn-warning me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('areas.index') }}" class="btn btn-sm btn-secondary">
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
                    {{-- Parking Name --}}
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Parking Name</strong></label>
                        <input type="text" class="form-control" value="{{ $area->name }}" readonly>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label><strong>Parking Name</strong></label>
                        <input type="text" class="form-control" value="{{ $area->name_in_bangla }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
