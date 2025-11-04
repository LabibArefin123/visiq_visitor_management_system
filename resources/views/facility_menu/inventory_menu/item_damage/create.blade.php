@extends('adminlte::page')

@section('title', 'Add Damaged Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Damaged Item</h3>
        <a href="{{ route('item_damages.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('item_damages.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><strong>Item Name</strong></label>
                            <input type="text" name="item_name"
                                class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"
                                placeholder="Enter item name">
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><strong>Item Name in Bangla</strong></label>
                            <input type="text" name="item_name_in_bangla"
                                class="form-control @error('item_name_in_bangla') is-invalid @enderror"
                                value="{{ old('item_name_in_bangla') }}" placeholder="Enter item name in Bangla">
                            @error('item_name_in_bangla')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group mt-3">
                            <label><strong>Quantity</strong></label>
                            <input type="number" name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}"
                                min="1">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group mt-3">
                            <label><strong>Reported By</strong></label>
                            <input type="text" name="reported_by"
                                class="form-control @error('reported_by') is-invalid @enderror"
                                value="{{ old('reported_by') }}" placeholder="Enter reporter name">
                            @error('reported_by')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group mt-3">
                            <label><strong>Damage Date</strong></label>
                            <input type="date" name="damage_date"
                                class="form-control @error('damage_date') is-invalid @enderror"
                                value="{{ old('damage_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                            @error('damage_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group mt-3">
                            <label><strong>Remarks</strong></label>
                            <textarea name="remarks" class="form-control">{{ old('remarks') }}</textarea>
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
