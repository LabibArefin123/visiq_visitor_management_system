@extends('adminlte::page')

@section('title', 'Add Interview Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add Interview Schedule</h3>
        <a href="{{ route('interview_schedules.index') }}"
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
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('interview_schedules.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="candidate_id"><strong>Candidate Name</strong> <span
                                    class="text-danger">*</span></label>
                            <select name="candidate_id" id="candidate_id"
                                class="form-control @error('candidate_id') is-invalid @enderror">
                                <option value="">Select Candidate</option>
                                @foreach ($candidates as $cand)
                                    <option value="{{ $cand->id }}"
                                        {{ old('candidate_id') == $cand->id ? 'selected' : '' }}>
                                        {{ $cand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('candidate_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="employee_id"><strong>Interviewer</strong> <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="interview_date"><strong>Interview Date & Time</strong> <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="interview_date" id="interview_date"
                                class="form-control @error('interview_date') is-invalid @enderror"
                                value="{{ old('interview_date') }}">
                            @error('interview_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="position"><strong>Position</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="position" id="position"
                                class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}"
                                placeholder="Enter position applied">
                            @error('position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="remarks"><strong>Remarks</strong></label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
