@extends('adminlte::page')

@section('title', 'View Visitor Company')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Company Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitor_companies.edit', $visitor_company->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitor_companies.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-6 form-group">
                    <label><strong>Company ID</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->company_id }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Company Name</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->company_name }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Contact Person</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->contact_person }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->email }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Phone</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->phone }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Address</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->address }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>City</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->city }}" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Country</strong></label>
                    <input type="text" class="form-control" value="{{ $visitor_company->country }}" readonly>
                </div>

            </div>
        </div>
    </div>
@stop
