@extends('adminlte::page')

@section('title', 'Edit ID Card')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit ID Card</h3>
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
    <div class="card shadow-lg">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('id_cards.update', $idCard->id) }}" method="POST" data-confirm="edit">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="card_number"><strong>Card Number</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="card_number" id="card_number"
                            class="form-control @error('card_number') is-invalid @enderror"
                            value="{{ old('card_number', $idCard->card_number) }}" placeholder="Enter card number">
                        @error('card_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="holder_type"><strong>Holder Type</strong> <span class="text-danger">*</span></label>
                        <select name="holder_type" id="holder_type"
                            class="form-control @error('holder_type') is-invalid @enderror">
                            <option value="">-- Select Type --</option>
                            <option value="employee"
                                {{ old('holder_type', $idCard->holder_type) == 'employee' ? 'selected' : '' }}>Employee
                            </option>
                            <option value="guard"
                                {{ old('holder_type', $idCard->holder_type) == 'guard' ? 'selected' : '' }}>Guard
                            </option>
                        </select>
                        @error('holder_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

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

                    <div class="col-md-6 form-group mt-3">
                        <label for="issue_date"><strong>Issue Date</strong> <span class="text-danger">*</span></label>
                        <input type="date" name="issue_date" id="issue_date"
                            class="form-control @error('issue_date') is-invalid @enderror"
                            value="{{ old('issue_date', optional($idCard->issue_date)->format('Y-m-d')) }}">
                        @error('issue_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label for="expiry_date"><strong>Expiry Date</strong> <span class="text-danger">*</span></label>
                        <input type="date" name="expiry_date" id="expiry_date"
                            class="form-control @error('expiry_date') is-invalid @enderror"
                            value="{{ old('expiry_date', optional($idCard->expiry_date)->format('Y-m-d')) }}">
                        @error('expiry_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mt-3">
                        <label for="status"><strong>Status</strong> <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">
                                Select Status</option>
                            <option value="active" {{ old('status', $idCard->status) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive" {{ old('status', $idCard->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                            <option value="expired" {{ old('status', $idCard->status) == 'expired' ? 'selected' : '' }}>
                                Expired</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group mt-3">
                        <label for="remarks"><strong>Remarks</strong></label>
                        <textarea name="remarks" id="remarks" rows="3" class="form-control" placeholder="Enter remarks">{{ old('remarks', $idCard->remarks) }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        let holderData = [];
        const holderType = document.getElementById('holder_type');
        const holderSelect = document.getElementById('holder_id');
        const cardNumberInput = document.getElementById('card_number');
        const selectedHolderType = "{{ $idCard->holder_type }}";
        const selectedHolderId = "{{ $idCard->holder_id }}";

        // Fetch holders based on existing type (for editing)
        function loadHolders(type, selectedId = null) {
            if (!type) return;
            fetch(`/get-holders/${type}`)
                .then(response => response.json())
                .then(data => {
                    holderData = data;
                    holderSelect.innerHTML = '<option value="">-- Select Holder --</option>';
                    data.forEach(item => {
                        holderSelect.innerHTML +=
                            `<option value="${item.id}" data-unique="${item.unique_code}" ${item.id == selectedId ? 'selected' : ''}>${item.name}</option>`;
                    });
                });
        }

        // On load (prefill existing)
        document.addEventListener('DOMContentLoaded', function() {
            if (selectedHolderType) {
                loadHolders(selectedHolderType, selectedHolderId);
            }
        });

        // When Holder Type changes
        holderType.addEventListener('change', function() {
            loadHolders(this.value);
            cardNumberInput.value = '';
        });

        // When Holder is selected → auto-fill card number
        holderSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const uniqueCode = selectedOption.getAttribute('data-unique');
            cardNumberInput.value = uniqueCode ? uniqueCode : '';
        });
    </script>
@stop
