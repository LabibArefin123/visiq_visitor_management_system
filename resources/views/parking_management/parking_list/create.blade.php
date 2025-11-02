@extends('adminlte::page')

@section('title', 'Add Parking')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Parking</h3>
        <a href="{{ route('parking_lists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                <form action="{{ route('parking_lists.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Parking Name --}}
                        <div class="col-md-6 form-group">
                            <label for="parking_name"><strong>Parking Name</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="parking_name" id="parking_name"
                                class="form-control @error('parking_name') is-invalid @enderror"
                                value="{{ old('parking_name') }}" placeholder="Enter parking name">
                            @error('parking_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Level --}}
                        <div class="col-md-6 form-group">
                            <label for="level"><strong>Level</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="level" id="level"
                                class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}"
                                placeholder="Enter level (e.g. Basement 1, Level 2)">
                            @error('level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available
                                </option>
                                <option value="Occupied" {{ old('status') == 'Occupied' ? 'selected' : '' }}>Occupied
                                </option>
                                <option value="Reserved" {{ old('status') == 'Reserved' ? 'selected' : '' }}>Reserved
                                </option>
                            </select>
                        </div>

                        {{-- Alloted By (optional) --}}
                        <div class="col-md-6 form-group">
                            <label for="alloted_by"><strong>Alloted By</strong> (Optional)</label>
                            <input type="text" name="alloted_by" id="alloted_by"
                                class="form-control @error('alloted_by') is-invalid @enderror"
                                value="{{ old('alloted_by') }}" placeholder="Enter employee/visitor name if any">
                            @error('alloted_by')
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
