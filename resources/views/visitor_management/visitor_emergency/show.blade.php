@extends('adminlte::page')

@section('title', 'View Visitor Emergency')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Emergency Details</h3>
        <a href="{{ route('visitor_emergencys.edit', $emergency->id) }}"
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
                    <div class="col-md-6 form-group">
                        <label><strong>Emergency ID:</strong></label>
                        <p class="form-control">{{ $emergency->emergency_id }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Name:</strong></label>
                        <p class="form-control">{{ $emergency->name }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Email:</strong></label>
                        <p class="form-control">{{ $emergency->email }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Phone:</strong></label>
                        <p class="form-control">{{ $emergency->phone }}</p>
                    </div>

                    <div class="col-md-12 form-group">
                        <label><strong>Reason:</strong></label>
                        <p class="form-control">{{ $emergency->reason }}</p>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Emergency At:</strong></label>
                        <p class="form-control">
                            {{ \Carbon\Carbon::parse($emergency->emergency_at)->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
