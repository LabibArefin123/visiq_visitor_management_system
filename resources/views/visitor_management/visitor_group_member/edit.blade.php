@extends('adminlte::page')

@section('title', 'Edit Visitor Group Member')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Visitor Group Member</h3>
        <a href="{{ route('visitor_group_members.index') }}"
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
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visitor_group_members.update', $group->id) }}" method="POST" data-confirm="edit">
                @csrf
                @method('PUT')
                <div class="row">

                    {{-- Group Name --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Group Name</strong> <span class="text-danger">*</span></label>
                        <input type="text" name="group_name"
                            class="form-control @error('group_name') is-invalid @enderror"
                            value="{{ old('group_name', $group->group_name) }}">
                        @error('group_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Total Members --}}
                    <div class="col-md-6 form-group">
                        <label><strong>Total Members</strong></label>
                        <input type="number" name="total_group_members" class="form-control"
                            value="{{ old('total_group_members', $group->total_group_members) }}" readonly>
                    </div>

                    {{-- Visitor List with Tick Marks --}}
                    <div class="col-12 mt-4">
                        <label><strong>Select Visitors</strong> <span class="text-danger">*</span></label>
                        <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;">
                            @php
                                // Get already selected visitor IDs as array
                                $selectedVisitors = old('visitor_ids', $group->visitor_ids ?? []);
                                if (is_string($selectedVisitors)) {
                                    $selectedVisitors = json_decode($selectedVisitors, true) ?? [];
                                }
                            @endphp

                            @foreach ($visitors->groupBy('purpose') as $purpose => $groupedVisitors)
                                <div class="mb-3">
                                    <h6 class="text-primary mb-2">{{ $purpose }}</h6>
                                    <div class="row">
                                        @foreach ($groupedVisitors as $visitor)
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" name="visitor_ids[]" value="{{ $visitor->id }}"
                                                        id="visitor_{{ $visitor->id }}"
                                                        class="form-check-input visitor-checkbox"
                                                        {{ in_array($visitor->id, $selectedVisitors) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="visitor_{{ $visitor->id }}">
                                                        {{ $visitor->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        @error('visitor_ids')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Update Group</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto update total selected members count
        const visitorCheckboxes = document.querySelectorAll('.visitor-checkbox');
        const totalInput = document.querySelector('input[name="total_group_members"]');

        function updateTotal() {
            totalInput.value = document.querySelectorAll('.visitor-checkbox:checked').length;
        }

        visitorCheckboxes.forEach(cb => cb.addEventListener('change', updateTotal));

        // Initialize on load
        updateTotal();
    </script>
@stop
