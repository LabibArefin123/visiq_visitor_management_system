@extends('adminlte::page')

@section('title', 'Add Room')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Room</h3>
        <a href="{{ route('room_lists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('room_lists.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Flat Name --}}
                        <div class="col-md-6 form-group">
                            <label for="flat_name"><strong>Flat Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="flat_name" id="flat_name"
                                class="form-control @error('flat_name') is-invalid @enderror" value="{{ old('flat_name') }}"
                                placeholder="Enter flat name">
                            @error('flat_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Flat Name (Bangla) --}}
                        <div class="col-md-6 form-group">
                            <label for="flat_name_in_bangla"><strong>Flat Name (Bangla)</strong></label>
                            <input type="text" name="flat_name_in_bangla" id="flat_name_in_bangla"
                                class="form-control @error('flat_name_in_bangla') is-invalid @enderror"
                                value="{{ old('flat_name_in_bangla') }}" placeholder="Enter flat name in Bangla">
                            @error('flat_name_in_bangla')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- User Category --}}
                        <div class="col-md-6 form-group">
                            <label for="user_category_id"><strong>User Category</strong></label>
                            <select name="user_category_id" id="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select User Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('user_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Area --}}
                        <div class="col-md-6 form-group">
                            <label for="area_id"><strong>Naval Area</strong></label>
                            <select name="area_id" id="area_id"
                                class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">-- Select Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Building Location --}}
                        <div class="col-md-6 form-group">
                            <label for="building_location_id"><strong>Building Location</strong></label>
                            <select name="building_location_id" id="building_location_id"
                                class="form-control @error('building_location_id') is-invalid @enderror">
                                <option value="">-- Select Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ old('building_location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Building List --}}
                        <div class="col-md-6 form-group">
                            <label for="building_list_id"><strong>Building Name</strong></label>
                            <select name="building_list_id" id="building_list_id"
                                class="form-control @error('building_list_id') is-invalid @enderror">
                                <option value="">-- Select Building --</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}"
                                        {{ old('building_list_id') == $building->id ? 'selected' : '' }}>
                                        {{ $building->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Level --}}
                        <div class="col-md-6 form-group">
                            <label for="level"><strong>Level</strong></label>
                            <input type="number" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}"
                                placeholder="Enter level number">
                            @error('level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
