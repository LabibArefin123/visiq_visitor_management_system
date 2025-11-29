@extends('adminlte::page')

@section('title', 'Show Building List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Building Details</h3>
        <div>
            <a href="{{ route('building_lists.edit', $buildingList->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-2 me-2">
                Edit
            </a>
            <a href="{{ route('building_lists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
                Back
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
                        <label><strong>Building Name</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Name in Bangla</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->name_in_bangla }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Building Category</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $buildingList->category->category_name ?? '' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Naval Area</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->area->name ?? '' }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Location</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->location->name ?? '' }}"
                            readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Level</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->level }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Unit Per Level</strong></label>
                        <input type="text" class="form-control" value="{{ $buildingList->unit_per_level }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" rows="3" readonly>{{ $buildingList->remarks }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
