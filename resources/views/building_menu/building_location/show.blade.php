@extends('adminlte::page')

@section('title', 'Building Location Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Building Location Details</h3>
        <div>
            <a href="{{ route('building_locations.edit', $building_location->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('building_locations.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">

                    {{-- User Category --}}
                    <div class="col-md-6 form-group">
                        <label><strong>User Category</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $building_location->userCategory->category_name ?? 'N/A' }}" readonly>
                    </div>

                    {{-- Area --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Area</strong></label>
                        <input type="text" class="form-control" value="{{ $building_location->area->name ?? 'N/A' }}"
                            readonly>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Building Location Name</strong></label>
                        <input type="text" class="form-control" value="{{ $building_location->name }}" readonly>
                    </div>

                    {{-- Name in Bangla --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Name in Bangla</strong></label>
                        <input type="text" class="form-control" value="{{ $building_location->name_in_bangla }}"
                            readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
