@extends('adminlte::page')

@section('title', 'Edit Emergency Visitor')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Emergency Visitor</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('visitor_emergency.update', $visitor->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <!-- E_ID -->
                <div class="mb-3">
                    <label for="e_id" class="form-label">Emergency Visitor ID</label>
                    <input type="text" id="e_id" name="e_id" class="form-control" value="{{ old('e_id', $visitor->e_id) }}" required>
                </div>
    
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $visitor->name) }}" required>
                </div>
    
                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $visitor->phone) }}" required>
                </div>
    
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $visitor->email) }}">
                </div>
    
                <!-- Reason for Emergency -->
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason for Emergency</label>
                    <textarea id="reason" name="reason" class="form-control" required>{{ old('reason', $visitor->reason) }}</textarea>
                </div>
    
                <!-- Emergency Date -->
                <div class="mb-3">
                    <label for="emergency_at" class="form-label">Emergency Date</label>
                    <input type="datetime-local" id="emergency_at" name="emergency_at" class="form-control"
                        value="{{ old('emergency_at', $visitor->emergency_at ? \Carbon\Carbon::parse($visitor->emergency_at)->format('Y-m-d\TH:i') : '') }}" required>
                </div>
    
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('visitor_emergency.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    
</div>
@endsection
