@extends('adminlte::page')

@section('title', 'View Visitor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Details</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('visitors.edit', $visitor->id) }}"
                class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('visitors.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><strong>Name:</strong></label>
                    <p class="form-control">{{ $visitor->name }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Phone:</strong></label>
                    <p class="form-control">{{ $visitor->phone ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Purpose:</strong></label>
                    <p class="form-control">{{ $visitor->purpose ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Visit Date:</strong></label>
                    <p class="form-control">{{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') }}
                    </p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Date of Birth:</strong></label>
                    <p class="form-control">
                        {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}
                    </p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Age:</strong></label>
                    <p class="form-control">
                        @if ($visitor->date_of_birth)
                            {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>National ID:</strong></label>
                    <p class="form-control">{{ $visitor->national_id ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Gender:</strong></label>
                    <p class="form-control">{{ $visitor->gender ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6 form-group">
                    <label><strong>Visitor Type:</strong></label>
                    <p class="form-control">{{ $visitor->visitor_type ?? 'Single' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
