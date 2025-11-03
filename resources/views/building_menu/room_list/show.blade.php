@extends('adminlte::page')

@section('title', 'Flat Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Flat Details</h3>
        <div>
            <a href="{{ route('room_lists.edit', $roomList->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('room_lists.index') }}" class="btn btn-sm btn-secondary ms-2">
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
                        <label><strong>Flat Name</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->room_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Flat Name (Bangla)</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->room_name_in_bangla }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>User Category</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->category->category_name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Naval Area</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->area->name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Location</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->location->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->building->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Level</strong></label>
                        <input type="text" class="form-control" value="{{ $roomList->level ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" readonly>{{ $roomList->remarks ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
