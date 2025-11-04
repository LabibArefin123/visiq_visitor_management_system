@extends('adminlte::page')

@section('title', 'Edit Supply Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Supply Item</h3>
        <a href="{{ route('supply_lists.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('supply_lists.update', $supplyList->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><strong>Item Name</strong></label>
                            <input type="text" name="item_name" value="{{ old('item_name', $supplyList->item_name) }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label><strong>Item Code</strong></label>
                            <input type="text" name="item_code" value="{{ old('item_code', $supplyList->item_code) }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label><strong>Category</strong></label>
                            <input type="text" name="category" value="{{ old('category', $supplyList->category) }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label><strong>Unit</strong></label>
                            <input type="text" name="unit" value="{{ old('unit', $supplyList->unit) }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label><strong>Quantity</strong></label>
                            <input type="number" name="quantity" value="{{ old('quantity', $supplyList->quantity) }}"
                                class="form-control" min="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label><strong>Reorder Level</strong></label>
                            <input type="number" name="reorder_level"
                                value="{{ old('reorder_level', $supplyList->reorder_level) }}" class="form-control"
                                min="0">
                        </div>
                        <div class="col-md-8 form-group">
                            <label><strong>Storage Location</strong></label>
                            <input type="text" name="location" value="{{ old('location', $supplyList->location) }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <textarea name="remarks" rows="3" class="form-control">{{ old('remarks', $supplyList->remarks) }}</textarea>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
