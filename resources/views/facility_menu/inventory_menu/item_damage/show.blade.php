@extends('adminlte::page')

@section('title', 'View Damaged Item')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Damaged Item Details</h3>
        <div>
            <a href="{{ route('item_damages.edit', $itemDamage->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('item_damages.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>Item Name</strong></label>
                        <input type="text" class="form-control" value="{{ $itemDamage->item_name }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label><strong>Item Name in Bangla</strong></label>
                        <input type="text" class="form-control" value="{{ $itemDamage->item_name_in_bangla }}" readonly>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label><strong>Quantity</strong></label>
                        <input type="text" class="form-control" value="{{ $itemDamage->quantity }}" readonly>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label><strong>Reported By</strong></label>
                        <input type="text" class="form-control" value="{{ $itemDamage->reported_by }}" readonly>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label><strong>Damage Date</strong></label>
                        <input type="text" class="form-control"
                            value="{{ $itemDamage->damage_date ? \Carbon\Carbon::parse($itemDamage->damage_date)->format('d M, Y') : '' }}"
                            readonly>
                    </div>

                    <div class="col-md-12 form-group mt-3">
                        <label><strong>Remarks</strong></label>
                        <textarea class="form-control" readonly>{{ $itemDamage->remarks }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
