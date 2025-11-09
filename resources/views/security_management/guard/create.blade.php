@extends('adminlte::page')

@section('title', 'Add Guard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Guard</h3>
        <a href="{{ route('guards.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-2">
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('guards.store') }}" method="POST" data-confirm="create">
                    @csrf
                    <div class="row">
                        {{-- Guard ID --}}
                        <div class="col-md-6 form-group">
                            <label for="guard_id"><strong>Guard ID</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="guard_id" id="guard_id"
                                class="form-control @error('guard_id') is-invalid @enderror" value="{{ old('guard_id') }}"
                                placeholder="Enter guard ID">
                            @error('guard_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name"><strong>Name</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter guard name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 form-group">
                            <label for="phone"><strong>Phone</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                placeholder="Enter phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter email (optional)">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="shift"><strong>Shift</strong> <span class="text-danger">*</span></label>
                            <select name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror">
                                <option value="">Select Shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->shift_name }}"
                                        {{ old('shift') == $shift->shift_name ? 'selected' : '' }}>
                                        {{ $shift->shift_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
