@extends('adminlte::page')

@section('title', 'Add Lost & Found Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add Lost & Found Item</h3>
        <a href="{{ route('lost_and_founds.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-arrow-left" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <form action="{{ route('lost_and_founds.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Item Name --}}
                        <div class="col-md-6 form-group">
                            <label for="item_name"><strong>Item Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="item_name" id="item_name"
                                class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"
                                placeholder="Enter item name">
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Visitor --}}
                        <div class="col-md-6 form-group">
                            <label for="visitor_id"><strong>Reported By (Visitor)</strong></label>
                            <select name="visitor_id" id="visitor_id"
                                class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">Select Visitor (optional)</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ old('visitor_id') == $visitor->id ? 'selected' : '' }}>
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
                            <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="Lost" {{ old('status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                                <option value="Found" {{ old('status') == 'Found' ? 'selected' : '' }}>Found</option>
                                <option value="Returned" {{ old('status') == 'Returned' ? 'selected' : '' }}>Returned
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-6 form-group">
                            <label for="location"><strong>Location</strong></label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}"
                                placeholder="Enter where it was found/lost">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reported Date --}}
                        <div class="col-md-6 form-group">
                            <label for="reported_date"><strong>Reported Date</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="reported_date" id="reported_date"
                                class="form-control @error('reported_date') is-invalid @enderror"
                                value="{{ old('reported_date') }}">
                            @error('reported_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 form-group">
                            <label for="description"><strong>Description</strong></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter any additional details">{{ old('description') }}</textarea>
                            @error('description')
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
