@extends('adminlte::page')

@section('title', 'Edit Building List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Building</h3>
        <a href="{{ route('building_lists.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('building_lists.update', $buildingList->id) }}" method="POST" data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="user_category_id"><strong>Building Category</strong></label>
                            <select name="user_category_id" id="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select Building Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $buildingList->user_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="area_id"><strong>Naval Area</strong></label>
                            <select name="area_id" id="area_id"
                                class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">-- Select Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $buildingList->area_id == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="building_location_id"><strong>Location</strong></label>
                            <select name="building_location_id" id="building_location_id"
                                class="form-control @error('building_location_id') is-invalid @enderror">
                                <option value="">-- Select Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ $buildingList->building_location_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="level"><strong>Level</strong></label>
                            <input type="number" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror"
                                value="{{ $buildingList->level }}" placeholder="Enter number of levels">
                            @error('level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="unit_per_level"><strong>Unit Per Level</strong></label>
                            <input type="number" name="unit_per_level" id="unit_per_level"
                                class="form-control @error('unit_per_level') is-invalid @enderror"
                                value="{{ $buildingList->unit_per_level }}" placeholder="Enter number of units per level">
                            @error('unit_per_level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks">{{ $buildingList->remarks }}</textarea>
                            @error('remarks')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
