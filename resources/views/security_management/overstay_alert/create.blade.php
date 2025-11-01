@extends('adminlte::page')

@section('title', 'Add Overstay Alert')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Overstay Alert</h3>
        <a href="{{ route('overstay_alerts.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('overstay_alerts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Visitor --}}
                        <div class="col-md-6 form-group">
                            <label for="visitor_id"><strong>Visitor</strong> <span class="text-danger">*</span></label>
                            <select name="visitor_id" id="visitor_id"
                                class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">Select Visitor</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ old('visitor_id') == $visitor->id ? 'selected' : '' }}>
                                        {{ $visitor->name }} ({{ $visitor->visitor_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('visitor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status"
                                class="form-control  @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Visit Date --}}
                        <div class="col-md-6 form-group">
                            <label for="visit_date"><strong>Visit Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="visit_date" id="visit_date"
                                class="form-control @error('visit_date') is-invalid @enderror"
                                value="{{ old('visit_date') }}">
                            @error('visit_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Expected Checkout Date --}}
                        <div class="col-md-6 form-group">
                            <label for="expected_checkout_date"><strong>Expected Checkout Date</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="expected_checkout_date" id="expected_checkout_date"
                                class="form-control @error('expected_checkout_date') is-invalid @enderror"
                                value="{{ old('expected_checkout_date') }}">
                            @error('expected_checkout_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Actual Checkout Date --}}
                        <div class="col-md-6 form-group">
                            <label for="actual_checkout_date"><strong>Actual Checkout Date</strong></label>
                            <input type="date" name="actual_checkout_date" id="actual_checkout_date"
                                class="form-control @error('actual_checkout_date') is-invalid @enderror"
                                value="{{ old('actual_checkout_date') }}">
                            @error('actual_checkout_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" class="form-control  @error('remarks') is-invalid @enderror" rows="3"
                                placeholder="Enter any remarks">{{ old('remarks') }}</textarea>
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
