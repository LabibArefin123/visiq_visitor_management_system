@extends('adminlte::page')

@section('title', 'View Blacklist Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Blacklist Visitor Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitor_blacklists.edit', $blacklistedVisitor->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_blacklists.index') }}"
                class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><strong>Name:</strong></label>
                    <p class="form-control">{{ $blacklistedVisitor->name }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Phone:</strong></label>
                    <p class="form-control">{{ $blacklistedVisitor->phone ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Email:</strong></label>
                    <p class="form-control">{{ $blacklistedVisitor->email ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Blacklist ID:</strong></label>
                    <p class="form-control">{{ $blacklistedVisitor->blacklist_id ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>National ID:</strong></label>
                    <p class="form-control">{{ $blacklistedVisitor->national_id ?? 'N/A' }}</p>
                </div>


                <div class="col-md-6 form-group">
                    <label><strong>Reason for Blacklist:</strong></label>
                    <p class="form-control">
                        {{ $blacklistedVisitor->reason ?? 'No reason provided' }}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
