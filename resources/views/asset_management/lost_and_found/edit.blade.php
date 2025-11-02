@extends('adminlte::page')

@section('title', 'Edit Lost & Found Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Lost & Found Item</h3>
        <a href="{{ route('lost_and_founds.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <form action="{{ route('lost_and_founds.update', $lostAndFound->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Item Name --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Item Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="item_name"
                                class="form-control @error('item_name') is-invalid @enderror"
                                value="{{ old('item_name', $lostAndFound->item_name) }}">
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Visitor --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Reported By (Visitor)</strong></label>
                            <select name="visitor_id" class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">Select Visitor</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ $lostAndFound->visitor_id == $visitor->id ? 'selected' : '' }}>
                                        {{ $visitor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('visitor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Status</strong></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="Lost" {{ $lostAndFound->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                                <option value="Found" {{ $lostAndFound->status == 'Found' ? 'selected' : '' }}>Found
                                </option>
                                <option value="Returned" {{ $lostAndFound->status == 'Returned' ? 'selected' : '' }}>
                                    Returned</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Location</strong></label>
                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $lostAndFound->location) }}">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reported Date --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Reported Date</strong></label>
                            <input type="date" name="reported_date"
                                class="form-control @error('reported_date') is-invalid @enderror"
                                value="{{ old('reported_date', $lostAndFound->reported_date->format('Y-m-d')) }}">
                            @error('reported_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $lostAndFound->description) }}</textarea>
                            @error('description')
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
