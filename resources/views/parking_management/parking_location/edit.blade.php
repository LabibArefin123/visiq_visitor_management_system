@extends('adminlte::page')

@section('title', 'Edit Parking Location')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Parking Location</h3>
        <a href="{{ route('parking_locations.index') }}"
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
                <form action="{{ route('parking_locations.update', $parkingList->id) }}" method="POST" data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Location Name --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Location Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $parkingList->name) }}" placeholder="Enter Location Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Location Name in Bangla --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Location Name (Bangla)</strong></label>
                            <input type="text" name="name_in_bangla"
                                class="form-control @error('name_in_bangla') is-invalid @enderror"
                                value="{{ old('name_in_bangla', $parkingList->name_in_bangla) }}"
                                placeholder="Enter Location Name in Bangla">
                            @error('name_in_bangla')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- User Category --}}
                        <div class="col-md-6 form-group">
                            <label><strong>User Category</strong> <span class="text-danger">*</span></label>
                            <select name="user_category_id" id="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select User Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('user_category_id', $parkingList->user_category_id) == $category->id ? 'selected' : '' }}>
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
                            <label><strong>Area</strong> <span class="text-danger">*</span></label>
                            <select id="area_id" name="area_id"
                                class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">-- Select Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_id', $parkingList->area_id) == $area->id ? 'selected' : '' }}>
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
                            <label><strong>Building Location</strong> <span class="text-danger">*</span></label>
                            <select id="building_location_id" name="building_location_id"
                                class="form-control @error('building_location_id') is-invalid @enderror">
                                <option value="">-- Select Location --</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ old('building_location_id', $parkingList->building_location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Building --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Building</strong> <span class="text-danger">*</span></label>
                            <select id="building_list_id" name="building_list_id"
                                class="form-control @error('building_list_id') is-invalid @enderror">
                                <option value="">-- Select Building --</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}"
                                        {{ old('building_list_id', $parkingList->building_list_id) == $building->id ? 'selected' : '' }}>
                                        {{ $building->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="parking_location_id"><strong>Parking Location</strong> <span
                                    class="text-danger">*</span></label>
                            <select id="parking_location_id" name="parking_location_id"
                                class="form-control @error('parking_location_id') is-invalid @enderror">
                                <option value="">-- Select Parking Location --</option>
                                @foreach ($plocations as $location)
                                    <option value="{{ $building->id }}"
                                        {{ old('parking_location_id', $parkingList->parking_location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parking_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Level --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Level</strong> <span class="text-danger">*</span></label>
                            <input type="number" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror"
                                value="{{ old('level', $parkingList->level) }}" placeholder="Enter level number">
                            @error('level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group">
                            <label><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks">{{ old('remarks', $parkingList->remarks) }}</textarea>
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

@section('js')
    <script>
        $(document).ready(function() {
            // Area change loads locations
            $('#area_id').on('change', function() {
                var areaID = $(this).val();
                $('#building_location_id').html('<option value="">Loading...</option>');
                $('#building_list_id').html('<option value="">-- Select Building --</option>');

                if (areaID) {
                    $.ajax({
                        url: '{{ route('ajax.getLocationsByArea') }}',
                        type: 'GET',
                        data: {
                            area_id: areaID
                        },
                        success: function(data) {
                            $('#building_location_id').html(
                                '<option value="">-- Select Location --</option>');
                            $.each(data, function(key, value) {
                                $('#building_location_id').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            // Location change loads buildings
            $('#building_location_id').on('change', function() {
                var locationID = $(this).val();
                $('#building_list_id').html('<option value="">Loading...</option>');

                if (locationID) {
                    $.ajax({
                        url: '{{ route('ajax.getBuildingsByLocation') }}',
                        type: 'GET',
                        data: {
                            building_location_id: locationID
                        },
                        success: function(data) {
                            $('#building_list_id').html(
                                '<option value="">-- Select Building --</option>');
                            $.each(data, function(key, value) {
                                $('#building_list_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
