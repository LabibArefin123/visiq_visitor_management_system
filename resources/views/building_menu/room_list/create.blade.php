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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('room_lists.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="room_name"><strong>Room Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="room_name" id="room_name"
                                class="form-control @error('room_name') is-invalid @enderror" value="{{ old('room_name') }}"
                                placeholder="Enter Room Name">
                            @error('room_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="room_name_in_bangla"><strong>Room Name (Bangla)</strong></label>
                            <input type="text" name="room_name_in_bangla" id="room_name_in_bangla"
                                class="form-control @error('room_name_in_bangla') is-invalid @enderror"
                                value="{{ old('room_name_in_bangla') }}" placeholder="Enter Room Name in Bangla">
                            @error('room_name_in_bangla')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="user_category_id"><strong>User Category</strong> <span
                                    class="text-danger">*</span></label>
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
                            <label for="level"><strong>Level</strong> <span class="text-danger">*</span></label>
                            <input type="number" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}"
                                placeholder="Enter level number">
                            @error('level')
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
                            $('#building_location_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

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
                        $('#building_list_id').html('<option value="">-- Select Building --</option>');
                        $.each(data, function(key, value) {
                            $('#building_list_id').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
