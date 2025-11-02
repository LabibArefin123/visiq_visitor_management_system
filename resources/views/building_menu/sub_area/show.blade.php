@extends('adminlte::page')

@section('title', 'View Sub Area')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Sub Area Details</h3>
        <div>
            <a href="{{ route('sub_areas.edit', $subArea->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('sub_areas.index') }}" class="btn btn-sm btn-secondary">Go Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Area Name</strong></label>
                        <input type="text" class="form-control" value="{{ $subArea->area->name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Sub Area Name</strong></label>
                        <input type="text" class="form-control" value="{{ $subArea->sub_area_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Sub Area Name (in Bangla)</strong></label>
                        <input type="text" class="form-control" value="{{ $subArea->sub_area_name_in_bangla }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
