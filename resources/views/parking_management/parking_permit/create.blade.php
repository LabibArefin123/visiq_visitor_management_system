@extends('adminlte::page')

@section('title', 'Add Parking Permit')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add Parking Permit</h3>
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
                <form action="{{ route('parking_permits.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="user_category_id"><strong>User Category</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="user_category_id" id="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select User Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('issued_by') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="visitor_id"><strong>Visitor Name</strong> <span class="text-danger">*</span></label>
                            <select name="visitor_id" id="visitor_id"
                                class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">-- Select Visitor --</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ old('issued_by') == $visitor->id ? 'selected' : '' }}>
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
                                        {{ old('issued_by') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('issued_by')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="area_id"><strong>Area</strong> <span class="text-danger">*</span></label>
                            <select id="area_id" name="area_id" class="form-control">
                                <option value="">-- Select Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="building_location_id"><strong>Building Location</strong> <span
                                    class="text-danger">*</span></label>
                            <select id="building_location_id" name="building_location_id" class="form-control">
                                <option value="">-- Select Location --</option>
                            </select>
                            @error('building_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="building_list_id"><strong>Building Name</strong> <span
                                    class="text-danger">*</span></label>
                            <select id="building_list_id" name="building_list_id" class="form-control">
                                <option value="">-- Select Building --</option>
                            </select>
                            @error('building_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="parking_location_id"><strong>Parking Location</strong> <span
                                    class="text-danger">*</span></label>
                            <select id="parking_location_id" name="parking_location_id" class="form-control">
                                <option value="">-- Select Parking Location --</option>
                            </select>
                            @error('parking_location_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="parking_list_id"><strong>Parking Name</strong> <span
                                    class="text-danger">*</span></label>
                            <select id="parking_list_id" name="parking_list_id" class="form-control">
                                <option value="">-- Select Parking --</option>
                            </select>
                            @error('parking_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Vacant" {{ old('status') == 'Vacant' ? 'selected' : '' }}>Vacant</option>
                                <option value="Occupied" {{ old('status') == 'Occupied' ? 'selected' : '' }}>Occupied
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="issue_date"><strong>Issue Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" id="issue_date"
                                class="form-control @error('issue_date') is-invalid @enderror"
                                value="{{ old('issue_date') }}">
                            @error('issue_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="expiry_date"><strong>Expiry Date</strong></label>
                            <input type="date" name="expiry_date" id="expiry_date"
                                class="form-control @error('expiry_date') is-invalid @enderror"
                                value="{{ old('expiry_date') }}">
                            @error('expiry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

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
@section('js')
    <script>
        $(document).ready(function() {

            // --- Helper function to load dropdowns dynamically ---
            function loadOptions(url, targetSelect, placeholder, requestData, selectedValue = null, groupByLevel =
                false) {
                $(targetSelect).html('<option value="">Loading...</option>');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        $(targetSelect).empty().append(`<option value="">${placeholder}</option>`);

                        if (data && data.length > 0) {

                            // ✅ Group by level if enabled
                            if (groupByLevel) {
                                // Group parking lists by level
                                const grouped = {};
                                data.forEach(item => {
                                    const level = item.level ? `Level ${item.level}` :
                                        'No Level Info';
                                    if (!grouped[level]) grouped[level] = [];
                                    grouped[level].push(item);
                                });

                                // Sort levels numerically (1, 2, 3…)
                                const sortedLevels = Object.keys(grouped).sort((a, b) => {
                                    const numA = parseInt(a.replace(/\D/g, '')) || 0;
                                    const numB = parseInt(b.replace(/\D/g, '')) || 0;
                                    return numA - numB;
                                });

                                // Append optgroups by level and names in ascending order
                                sortedLevels.forEach(levelLabel => {
                                    let group = $('<optgroup>', {
                                        label: levelLabel
                                    });
                                    grouped[levelLabel]
                                        .sort((a, b) => a.name.localeCompare(b.name))
                                        .forEach(value => {
                                            let selected = (selectedValue == value.id) ?
                                                'selected' : '';
                                            group.append(
                                                `<option value="${value.id}" ${selected}>${value.name}</option>`
                                            );
                                        });
                                    $(targetSelect).append(group);
                                });
                            } else {
                                // Normal dropdown
                                $.each(data, function(_, value) {
                                    let selected = (selectedValue == value.id) ? 'selected' :
                                        '';
                                    $(targetSelect).append(
                                        `<option value="${value.id}" ${selected}>${value.name}</option>`
                                    );
                                });
                            }
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
                $('#building_location_id, #building_list_id, #parking_location_id, #parking_list_id')
                    .html('<option value="">-- Select --</option>');
                $('#level').val('');
                if (areaID) {
                    loadOptions('{{ route('ajax.getLocationsByArea') }}', '#building_location_id',
                        '-- Select Location --', {
                            area_id: areaID
                        });
                }
            });

            // --- Location → Building ---
            $('#building_location_id').on('change', function() {
                let locationID = $(this).val();
                $('#building_list_id, #parking_location_id, #parking_list_id').html(
                    '<option value="">-- Select --</option>');
                $('#level').val('');
                if (locationID) {
                    loadOptions('{{ route('ajax.getBuildingsByLocation') }}', '#building_list_id',
                        '-- Select Building Name --', {
                            building_location_id: locationID
                        });
                }
            });

            // --- Building → Parking Location ---
            $('#building_list_id').on('change', function() {
                let buildingID = $(this).val();
                $('#parking_location_id, #parking_list_id').html('<option value="">-- Select --</option>');
                $('#level').val('');
                if (buildingID) {
                    loadOptions('{{ route('ajax.getParkingLocationByBuildingName') }}',
                        '#parking_location_id', '-- Select Parking Location --', {
                            building_list_id: buildingID
                        });
                }
            });

            // --- Parking Location → Parking Name (✅ grouped by level) ---
            $('#parking_location_id').on('change', function() {
                let parkingLocationID = $(this).val();
                $('#parking_list_id').html('<option value="">Loading...</option>');
                $('#level').val('');

                if (parkingLocationID) {
                    loadOptions('{{ route('ajax.getParkingByParkingLocationName') }}',
                        '#parking_list_id', '-- Select Parking Name --', {
                            parking_location_id: parkingLocationID
                        },
                        null, true // enable level grouping
                    );
                }
            });

            // --- Restore old values when validation fails ---
            let oldArea = "{{ old('area_id') }}";
            let oldLocation = "{{ old('building_location_id') }}";
            let oldBuilding = "{{ old('building_list_id') }}";
            let oldParkingLocation = "{{ old('parking_location_id') }}";
            let oldParking = "{{ old('parking_list_id') }}";
            let oldLevel = "{{ old('level') }}";

            if (oldArea) {
                loadOptions('{{ route('ajax.getLocationsByArea') }}', '#building_location_id',
                    '-- Select Location --', {
                        area_id: oldArea
                    }, oldLocation);

                if (oldLocation) {
                    setTimeout(() => {
                        loadOptions('{{ route('ajax.getBuildingsByLocation') }}', '#building_list_id',
                            '-- Select Building Name --', {
                                building_location_id: oldLocation
                            }, oldBuilding);
                    }, 400);
                }

                if (oldBuilding) {
                    setTimeout(() => {
                        loadOptions('{{ route('ajax.getParkingLocationByBuildingName') }}',
                            '#parking_location_id',
                            '-- Select Parking Location --', {
                                building_list_id: oldBuilding
                            }, oldParkingLocation);
                    }, 800);
                }

                if (oldParkingLocation) {
                    setTimeout(() => {
                        loadOptions('{{ route('ajax.getParkingByParkingLocationName') }}',
                            '#parking_list_id',
                            '-- Select Parking Name --', {
                                parking_location_id: oldParkingLocation
                            }, oldParking, true);
                        $('#level').val(oldLevel);
                    }, 1200);
                }
            }
        });
    </script>
@endsection
