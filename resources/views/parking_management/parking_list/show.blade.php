@extends('adminlte::page')

@section('title', 'Parking List Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Parking List Details</h3>
        <div>
            <a href="{{ route('parking_lists.edit', $parkingList->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('parking_lists.index') }}" class="btn btn-sm btn-secondary ms-2">
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
                    <div class="col-md-6 form-group">
                        <label><strong>Location Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Location Name (Bangla)</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->name_in_bangla }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>User Category</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $parkingList->userCategory->category_name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Area</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->area->name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Location</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->location->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->building->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Parking Location Name</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->plocation->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Level</strong></label>
                        <input type="text" class="form-control" value="{{ $parkingList->level ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" readonly>{{ $parkingList->remarks ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
