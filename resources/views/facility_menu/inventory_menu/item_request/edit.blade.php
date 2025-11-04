@extends('adminlte::page')

@section('title', 'Edit Item Request')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Item Request</h3>
        <a href="{{ route('item_requests.index') }}"
            class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('item_requests.update', $itemRequest->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Supply Item --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Supply Item</strong></label>
                            <select name="supply_list_id"
                                class="form-control @error('supply_list_id') is-invalid @enderror">
                                <option value="">Select Supply</option>

                                @php
                                    // Group supplies by category
                                    $groupedSupplies = $supplies->groupBy('category');
                                @endphp

                                @foreach ($groupedSupplies as $category => $items)
                                    <optgroup label="{{ $category }}">
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('supply_list_id', $itemRequest->supply_list_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->item_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            @error('supply_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Requester Name --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Requester Name</strong></label>
                            <input type="text" name="requester_name"
                                class="form-control @error('requester_name') is-invalid @enderror"
                                value="{{ old('requester_name', $itemRequest->requester_name) }}">
                            @error('requester_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Department --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Department</strong></label>
                            <input type="text" name="department"
                                class="form-control @error('department') is-invalid @enderror"
                                value="{{ old('department', $itemRequest->department) }}">
                            @error('department')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Request Type --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Request Type</strong></label>
                            <input type="text" name="request_type"
                                class="form-control @error('request_type') is-invalid @enderror"
                                value="{{ old('request_type', $itemRequest->request_type) }}">
                            @error('request_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Quantity</strong></label>
                            <input type="number" name="quantity" min="1"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', $itemRequest->quantity) }}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Status</strong></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending"
                                    {{ old('status', $itemRequest->status) == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved"
                                    {{ old('status', $itemRequest->status) == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected"
                                    {{ old('status', $itemRequest->status) == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group mt-3">
                            <label><strong>Remarks</strong></label>
                            <textarea name="remarks" rows="3" class="form-control">{{ old('remarks', $itemRequest->remarks) }}</textarea>
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
