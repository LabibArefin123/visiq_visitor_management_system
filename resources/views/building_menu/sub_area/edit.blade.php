@extends('adminlte::page')

@section('title', 'Edit Sub Area')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Sub Area</h3>
        <a href="{{ route('sub_areas.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                <form action="{{ route('sub_areas.update', $subArea->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Area --}}
                        <div class="col-md-6 form-group">
                            <label for="area_id"><strong>Select Area</strong></label>
                            <select name="area_id" id="area_id"
                                class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">-- Choose Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $subArea->area_id == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sub Area Name --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Sub Area Name</strong></label>
                            <input type="text" name="sub_area_name" class="form-control"
                                value="{{ $subArea->sub_area_name }}">
                        </div>

                        {{-- Bangla Name --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Sub Area Name (in Bangla)</strong></label>
                            <input type="text" name="sub_area_name_in_bangla" class="form-control"
                                value="{{ $subArea->sub_area_name_in_bangla }}">
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
