@extends('adminlte::page')

@section('title', 'Edit Seat Allocation')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Seat Allocation</h3>
        <a href="{{ route('seat_allocations.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                <form action="{{ route('seat_allocations.update', $seatAllocation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- User Category --}}
                        <div class="col-md-6 form-group">
                            <label><strong>User Category</strong> <span class="text-danger">*</span></label>
                            <select name="user_category_id"
                                class="form-control @error('user_category_id') is-invalid @enderror">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('user_category_id', $seatAllocation->user_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Room --}}
                        <div class="col-md-6 form-group">
                            <label><strong>Room</strong> <span class="text-danger">*</span></label>
                            <select name="room_list_id" class="form-control @error('room_list_id') is-invalid @enderror">
                                <option value="">-- Select Room --</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ old('room_list_id', $seatAllocation->room_list_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_name }} (Level {{ $room->level }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_list_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Seat Number --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Seat Number</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="seat_number"
                                value="{{ old('seat_number', $seatAllocation->seat_number) }}"
                                class="form-control @error('seat_number') is-invalid @enderror"
                                placeholder="Enter seat number">
                            @error('seat_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Employee --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Employee (if applicable)</strong></label>
                            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="">-- Select Employee --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $seatAllocation->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }} ({{ $employee->emp_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Visitor --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Visitor (if applicable)</strong></label>
                            <select name="visitor_id" class="form-control @error('visitor_id') is-invalid @enderror">
                                <option value="">-- Select Visitor --</option>
                                @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }}"
                                        {{ old('visitor_id', $seatAllocation->visitor_id) == $visitor->id ? 'selected' : '' }}>
                                        {{ $visitor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('visitor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Allocation Date --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Allocation Date</strong> <span class="text-danger">*</span></label>
                            <input type="date" name="allocation_date"
                                value="{{ old('allocation_date', $seatAllocation->allocation_date) }}"
                                class="form-control @error('allocation_date') is-invalid @enderror">
                            @error('allocation_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Remarks --}}
                        <div class="col-md-6 form-group mt-3">
                            <label><strong>Remarks</strong></label>
                            <input type="text" name="remarks" value="{{ old('remarks', $seatAllocation->remarks) }}"
                                class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="Enter remarks (optional)">
                            @error('remarks')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
