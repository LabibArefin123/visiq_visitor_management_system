@extends('adminlte::page')

@section('title', 'Add Supply Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Supply Item</h3>
        <a href="{{ route('supply_lists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                <form action="{{ route('supply_lists.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="item_name"><strong>Item Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="item_name" id="item_name"
                                class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"
                                placeholder="Enter item name">
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="item_code"><strong>Item Code</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="item_code" id="item_code"
                                class="form-control @error('item_code') is-invalid @enderror" value="{{ old('item_code') }}"
                                placeholder="Enter unique code (e.g. SUP-001)">
                            @error('item_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label for="category"><strong>Category</strong></label>
                            <input type="text" name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}"
                                placeholder="Enter category (e.g. Stationery)">
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="unit"><strong>Unit</strong></label>
                            <input type="text" name="unit" id="unit"
                                class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}"
                                placeholder="Enter unit (e.g. pcs, box)">
                            @error('unit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="quantity"><strong>Quantity</strong></label>
                            <input type="number" name="quantity" id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', 0) }}" min="0">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label for="reorder_level"><strong>Reorder Level</strong></label>
                            <input type="number" name="reorder_level" id="reorder_level"
                                class="form-control @error('reorder_level') is-invalid @enderror"
                                value="{{ old('reorder_level', 0) }}" min="0">
                            @error('reorder_level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-8 form-group">
                            <label for="location"><strong>Storage Location</strong></label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}"
                                placeholder="Enter storage location (e.g. Store Room A)">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="remarks"><strong>Remarks</strong></label>
                        <textarea name="remarks" id="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror"
                            placeholder="Enter any additional notes">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
