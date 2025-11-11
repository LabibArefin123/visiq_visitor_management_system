@extends('adminlte::page')

@section('title', 'Edit Parking Permit')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Parking Permit</h3>
        <a href="{{ route('parking_permits.index') }}"
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
                <form action="{{ route('parking_permits.update', $parkingPermit->id) }}" method="POST" data-confirm="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- User Category --}}
                        <div class="col-md-6 form-group">
                            <label><strong>User Category</strong> <span class="text-danger">*</span></label>
                            <select name="user_category_id" id="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select User Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('user_category_id', $parkingPermit->user_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="visitor_id"><strong>Issued By</strong> <span class="text-danger">*</span></label>
                            <select name="visitor_id" id="visitor_id"
                                class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">-- Select User --</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ old('visitor_id', $parkingPermit->visitor_id) == $visitor->id ? 'selected' : '' }}>
                                        {{ $visitor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('visitor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="issued_by"><strong>Issued By</strong> <span class="text-danger">*</span></label>
                            <select name="issued_by" id="issued_by"
                                class="form-control @error('issued_by') is-invalid @enderror">
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('issued_by', $parkingPermit->issued_by) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('issued_by')
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
                                        {{ old('area_id', $parkingPermit->area_id) == $area->id ? 'selected' : '' }}>
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
                                        {{ old('building_location_id', $parkingPermit->building_location_id) == $location->id ? 'selected' : '' }}>
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
                            <label><strong>Building Name</strong> <span class="text-danger">*</span></label>
                            <select id="building_list_id" name="building_list_id"
                                class="form-control @error('building_list_id') is-invalid @enderror">
                                <option value="">-- Select Building --</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}"
                                        {{ old('building_list_id', $parkingPermit->building_list_id) == $building->id ? 'selected' : '' }}>
                                        {{ $building->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Parking Name</strong> <span class="text-danger">*</span></label>
                            <select id="parking_location_id" name="parking_location_id"
                                class="form-control @error('parking_location_id') is-invalid @enderror">
                                <option value="">-- Select Building --</option>
                                @foreach ($plocations as $ploc)
                                    <option value="{{ $building->id }}"
                                        {{ old('parking_location_id', $parkingPermit->parking_location_id) == $ploc->id ? 'selected' : '' }}>
                                        {{ $ploc->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parking_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Parking Name</strong> <span class="text-danger">*</span></label>
                            <select id="parking_list_id" name="parking_list_id"
                                class="form-control @error('parking_list_id') is-invalid @enderror">
                                <option value="">-- Select Parking --</option>
                                @foreach ($parkingLists as $park)
                                    <option value="{{ $building->id }}"
                                        {{ old('parking_list_id', $parkingPermit->parking_list_id) == $park->id ? 'selected' : '' }}>
                                        {{ $park->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parking_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="issue_date"><strong>Issue Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" id="issue_date"
                                class="form-control @error('issue_date') is-invalid @enderror"
                                value="{{ old('issue_date', $parkingPermit->issue_date) }}">
                            @error('issue_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="expiry_date"><strong>Expiry Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="expiry_date" id="expiry_date"
                                class="form-control @error('expiry_date') is-invalid @enderror"
                                value="{{ old('expiry_date', $parkingPermit->expiry_date) }}">
                            @error('expiry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Status</strong></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">
                                    Select Status</option>
                                <option value="Vacant" {{ $parkingPermit->status == 'Vacant' ? 'selected' : '' }}>
                                    Vacant</option>
                                <option value="Occupied" {{ $parkingPermit->status == 'Occupied' ? 'selected' : '' }}>
                                    Occupied
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group">
                            <label><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks">{{ old('remarks', $parkingPermit->remarks) }}</textarea>
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

            // --- Helper function to load dropdowns dynamically ---
            function loadOptions(url, targetSelect, placeholder, requestData, selectedValue = null) {
                $(targetSelect).html('<option value="">Loading...</option>');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        $(targetSelect).html(`<option value="">${placeholder}</option>`);
                        if (data.length > 0) {
                            $.each(data, function(_, value) {
                                let selected = (selectedValue == value.id) ? 'selected' : '';
                                $(targetSelect).append(
                                    `<option value="${value.id}" ${selected}>${value.name}</option>`
                                );
                            });
                        } else {
                            $(targetSelect).append('<option value="">No data found</option>');
                        }
                    },
                    error: function() {
                        $(targetSelect).html('<option value="">Error loading data</option>');
                    }
                });
            }

            // --- Area → Location ---
            $('#area_id').on('change', function() {
                let areaID = $(this).val();
                $('#building_location_id').html('<option value="">-- Select Location --</option>');
                $('#building_list_id').html('<option value="">-- Select Building Name --</option>');
                $('#parking_location_id').html('<option value="">-- Select Parking Location --</option>');
                $('#parking_list_id').html('<option value="">-- Select Parking Name --</option>');
                if (areaID) {
                    loadOptions('{{ route('ajax.getLocationsByArea') }}',
                        '#building_location_id',
                        '-- Select Location --', {
                            area_id: areaID
                        });
                }
            });

            // --- Location → Building ---
            $('#building_location_id').on('change', function() {
                let locationID = $(this).val();
                $('#building_list_id').html('<option value="">Loading...</option>');
                $('#parking_location_id').html('<option value="">-- Select Parking Location --</option>');
                $('#parking_list_id').html('<option value="">-- Select Parking Name --</option>');
                if (locationID) {
                    loadOptions('{{ route('ajax.getBuildingsByLocation') }}',
                        '#building_list_id',
                        '-- Select Building Name --', {
                            building_location_id: locationID
                        });
                }
            });

            // --- Building → Parking Location ---
            $('#building_list_id').on('change', function() {
                let buildingID = $(this).val();
                $('#parking_location_id').html('<option value="">Loading...</option>');
                $('#parking_list_id').html('<option value="">-- Select Parking Name --</option>');
                if (buildingID) {
                    loadOptions('{{ route('ajax.getParkingLocationByBuildingName') }}',
                        '#parking_location_id',
                        '-- Select Parking Location --', {
                            building_list_id: buildingID
                        });
                }
            });

            // --- Parking Location → Parking Name ---
            $('#parking_location_id').on('change', function() {
                let parkingLocationID = $(this).val();
                $('#parking_list_id').html('<option value="">Loading...</option>');
                if (parkingLocationID) {
                    loadOptions('{{ route('ajax.getParkingByParkingLocationName') }}',
                        '#parking_list_id',
                        '-- Select Parking Name --', {
                            parking_location_id: parkingLocationID
                        });
                }
            });

            // --- 🔹 Auto-load old values when validation fails ---
            let oldArea = "{{ old('area_id') }}";
            let oldLocation = "{{ old('building_location_id') }}";
            let oldBuilding = "{{ old('building_list_id') }}";
            let oldParkingLocation = "{{ old('parking_location_id') }}";
            let oldParking = "{{ old('parking_list_id') }}";

            if (oldArea) {
                // Load locations first
                loadOptions('{{ route('ajax.getLocationsByArea') }}',
                    '#building_location_id', '-- Select Location --', {
                        area_id: oldArea
                    },
                    oldLocation
                );

                // Then buildings
                if (oldLocation) {
                    setTimeout(function() {
                        loadOptions('{{ route('ajax.getBuildingsByLocation') }}',
                            '#building_list_id', '-- Select Building Name --', {
                                building_location_id: oldLocation
                            },
                            oldBuilding
                        );
                    }, 400);
                }

                // Then parking locations
                if (oldBuilding) {
                    setTimeout(function() {
                        loadOptions('{{ route('ajax.getParkingLocationByBuildingName') }}',
                            '#parking_location_id', '-- Select Parking Location --', {
                                building_list_id: oldBuilding
                            },
                            oldParkingLocation
                        );
                    }, 800);
                }

                // Then parking names
                if (oldParkingLocation) {
                    setTimeout(function() {
                        loadOptions('{{ route('ajax.getParkingByParkingLocationName') }}',
                            '#parking_list_id', '-- Select Parking Name --', {
                                parking_location_id: oldParkingLocation
                            },
                            oldParking
                        );
                    }, 1200);
                }
            }
        });
    </script>
@endsection
