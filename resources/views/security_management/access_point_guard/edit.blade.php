@extends('adminlte::page')

@section('title', 'Edit Access Point Guard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Access Point Guard</h3>
        <a href="{{ route('access_point_guards.index') }}"
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
    <div class="container">
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <form action="{{ route('access_point_guards.update', $accessPointGuard->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- Access Point --}}
                        <div class="col-md-6 form-group">
                            <label for="access_point_id"><strong>Access Point</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="access_point_id" id="access_point_id"
                                class="form-control @error('access_point_id') is-invalid @enderror">
                                <option value="">Select Access Point</option>
                                @foreach ($accessPoints as $point)
                                    <option value="{{ $point->id }}"
                                        {{ old('access_point_id', $accessPointGuard->access_point_id) == $point->id ? 'selected' : '' }}>
                                        {{ $point->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('access_point_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Guard --}}
                        <div class="col-md-6 form-group">
                            <label for="guard_id"><strong>Guard</strong> <span class="text-danger">*</span></label>
                            <select name="guard_id" id="guard_id"
                                class="form-control @error('guard_id') is-invalid @enderror">
                                <option value="">Select Guard</option>

                                @php
                                    // Group guards by shift
                                    $shiftsGrouped = $guards->groupBy('shift');
                                @endphp

                                @foreach ($shiftsGrouped as $shiftName => $guardsInShift)
                                    <optgroup label="{{ $shiftName ?: 'No Shift' }}">
                                        @foreach ($guardsInShift as $guard)
                                            @php
                                                $schedule = \App\Models\ShiftGuardSchedule::where(
                                                    'shift_name',
                                                    $guard->shift,
                                                )->first();
                                            @endphp
                                            <option value="{{ $guard->id }}"
                                                data-shift-start="{{ $schedule->start_time ?? '' }}"
                                                data-shift-end="{{ $schedule->end_time ?? '' }}"
                                                {{ old('guard_id', $accessPointGuard->guard_id) == $guard->id ? 'selected' : '' }}>
                                                {{ $guard->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('guard_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Shift Start --}}
                        <div class="col-md-6 form-group">
                            <label for="shift_start"><strong>Shift Start</strong></label>
                            <input type="time" name="shift_start" id="shift_start"
                                class="form-control @error('shift_start') is-invalid @enderror"
                                value="{{ old('shift_start', $accessPointGuard->shift_start) }}" readonly>
                            @error('shift_start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Shift End --}}
                        <div class="col-md-6 form-group">
                            <label for="shift_end"><strong>Shift End</strong></label>
                            <input type="time" name="shift_end" id="shift_end"
                                class="form-control @error('shift_end') is-invalid @enderror"
                                value="{{ old('shift_end', $accessPointGuard->shift_end) }}" readonly>
                            @error('shift_end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const guardSelect = document.getElementById('guard_id');
            const shiftStart = document.getElementById('shift_start');
            const shiftEnd = document.getElementById('shift_end');

            function fillShiftTimes() {
                const selectedOption = guardSelect.options[guardSelect.selectedIndex];
                const start = selectedOption.getAttribute('data-shift-start') || '';
                const end = selectedOption.getAttribute('data-shift-end') || '';

                shiftStart.value = start;
                shiftEnd.value = end;

                if (start && end) {
                    shiftStart.readOnly = true;
                    shiftEnd.readOnly = true;
                } else {
                    shiftStart.readOnly = false;
                    shiftEnd.readOnly = false;
                }
            }

            guardSelect.addEventListener('change', fillShiftTimes);

            // Pre-fill on page load
            fillShiftTimes();
        });
    </script>
@stop
