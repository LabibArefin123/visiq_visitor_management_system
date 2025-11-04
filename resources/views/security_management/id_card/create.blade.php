@extends('adminlte::page')

@section('title', 'Add ID Card')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New ID Card</h3>
        <a href="{{ route('id_cards.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2 back-btn">
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
                <form action="{{ route('id_cards.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        {{-- Card Number --}}
                        <div class="col-md-6 form-group">
                            <label for="card_number"><strong>Card Number</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="card_number" id="card_number"
                                class="form-control @error('card_number') is-invalid @enderror"
                                value="{{ old('card_number') }}" placeholder="Enter card number">
                            @error('card_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Holder Type --}}
                        <div class="col-md-6 form-group">
                            <label for="holder_type"><strong>Holder Type</strong> <span class="text-danger">*</span></label>
                            <select name="holder_type" id="holder_type"
                                class="form-control @error('holder_type') is-invalid @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="employee" {{ old('holder_type') == 'employee' ? 'selected' : '' }}>Employee
                                </option>
                                <option value="visitor" {{ old('holder_type') == 'visitor' ? 'selected' : '' }}>Visitor
                                </option>
                                <option value="guard" {{ old('holder_type') == 'guard' ? 'selected' : '' }}>Guard</option>
                            </select>
                            @error('holder_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Holder Name (dynamic) --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="holder_id"><strong>Card Holder</strong> <span class="text-danger">*</span></label>
                            <select name="holder_id" id="holder_id"
                                class="form-control @error('holder_id') is-invalid @enderror">
                                <option value="">-- Select Holder --</option>
                            </select>
                            @error('holder_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Issue Date --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="issue_date"><strong>Issue Date</strong></label>
                            <input type="date" name="issue_date" id="issue_date"
                                class="form-control @error('issue_date') is-invalid @enderror"
                                value="{{ old('issue_date') }}">
                            @error('issue_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Expiry Date --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="expiry_date"><strong>Expiry Date</strong></label>
                            <input type="date" name="expiry_date" id="expiry_date"
                                class="form-control @error('expiry_date') is-invalid @enderror"
                                value="{{ old('expiry_date') }}">
                            @error('expiry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group mt-3">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-12 form-group mt-3">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control" placeholder="Enter remarks">{{ old('remarks') }}</textarea>
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
@section('js')
    <script>
        let holderData = [];

        // When Holder Type changes
        document.getElementById('holder_type').addEventListener('change', function() {
            const type = this.value;
            const holderSelect = document.getElementById('holder_id');
            const cardNumberInput = document.getElementById('card_number');

            holderSelect.innerHTML = '<option value="">Loading...</option>';
            cardNumberInput.value = ''; // reset card number

            if (type) {
                fetch(`/get-holders/${type}`)
                    .then(response => response.json())
                    .then(data => {
                        holderData = data; // store full data
                        holderSelect.innerHTML = '<option value="">-- Select Holder --</option>';
                        data.forEach(item => {
                            holderSelect.innerHTML +=
                                `<option value="${item.id}" data-unique="${item.unique_code}">${item.name}</option>`;
                        });
                    })
                    .catch(() => {
                        holderSelect.innerHTML = '<option value="">Error loading data</option>';
                    });
            } else {
                holderSelect.innerHTML = '<option value="">-- Select Holder --</option>';
            }
        });

        // When Holder is selected, auto-fill card number
        document.getElementById('holder_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const uniqueCode = selectedOption.getAttribute('data-unique');
            document.getElementById('card_number').value = uniqueCode ? uniqueCode : '';
        });
    </script>
@stop
