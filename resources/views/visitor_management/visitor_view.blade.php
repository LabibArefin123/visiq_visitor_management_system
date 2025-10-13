@extends('adminlte::page')

@section('title', 'View Visitor')

@section('content')
<div class="container">
    <h2 class="mb-4">Visitor Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong>{{ $visitor->name }}</p>
            <p><strong>Phone:</strong> {{ $visitor->phone ?? 'N/A' }}</p>
            <p><strong>Purpose:</strong> {{ $visitor->purpose ?? 'N/A' }}</p>
            <p><strong>Visit Date:</strong> {{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') }}</p>
            <p><strong>Date of Birth:</strong> 
                {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}
            </p>
            <p><strong>Age:</strong> 
                @if ($visitor->date_of_birth)
                    {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
                @else
                    N/A
                @endif
            </p>
            <p><strong>National ID:</strong> {{ $visitor->national_id ?? 'N/A' }}</p>
            <p><strong>Gender:</strong> {{ $visitor->gender ?? 'N/A' }}</p>
            <p><strong>Visitor Type:</strong> {{ $visitor->visitor_type ?? 'Single' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('visitor_management') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('visitor.update', $visitor->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('visitor.delete', $visitor->id) }}" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <div style="position: fixed; bottom: 5px; right: 5px; text-align: middle;">
        <p class="text-muted medium">
            Design and Developed by
            <a href="https://www.totalofftec.com" target="_blank" style="color: #007bff;">TOTALOFFTEC</a>
        </p>
    </div>
@endsection