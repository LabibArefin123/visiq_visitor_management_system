@extends('adminlte::page')

@section('title', 'Edit Stock Log')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Stock Log</h3>
        <a href="{{ route('stock_logs.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('stock_logs.update', $stock_log->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Supply Item --}}
                        <div class="col-md-6 form-group">
                            <label for="supply_list_id"><strong>Supply Item</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="supply_list_id" id="supply_list_id"
                                class="form-control @error('supply_list_id') is-invalid @enderror">
                                <option value="">Select Item</option>
                                @foreach ($supplies as $supply)
                                    <option value="{{ $supply->id }}"
                                        {{ old('supply_list_id', $stock_log->supply_list_id) == $supply->id ? 'selected' : '' }}>
                                        {{ $supply->item_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supply_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Log Type --}}
                        <div class="col-md-6 form-group">
                            <label for="log_type"><strong>Log Type</strong> <span class="text-danger">*</span></label>
                            <select name="log_type" id="log_type"
                                class="form-control @error('log_type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="stock_in"
                                    {{ old('log_type', $stock_log->log_type) == 'stock_in' ? 'selected' : '' }}>Stock In
                                </option>
                                <option value="stock_out"
                                    {{ old('log_type', $stock_log->log_type) == 'stock_out' ? 'selected' : '' }}>Stock Out
                                </option>
                            </select>
                            @error('log_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="quantity"><strong>Quantity</strong> <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', $stock_log->quantity) }}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Recorded By --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="recorded_by"><strong>Recorded By</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="recorded_by" id="recorded_by"
                                class="form-control @error('recorded_by') is-invalid @enderror"
                                value="{{ old('recorded_by', $stock_log->recorded_by) }}">
                            @error('recorded_by')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Log Date --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="log_date"><strong>Log Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="log_date" id="log_date"
                                class="form-control @error('log_date') is-invalid @enderror"
                                value="{{ old('log_date', $stock_log->log_date) }}">
                            @error('log_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group mt-3">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control">{{ old('remarks', $stock_log->remarks) }}</textarea>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
