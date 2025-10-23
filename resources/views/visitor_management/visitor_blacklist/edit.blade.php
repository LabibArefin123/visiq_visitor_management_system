@extends('adminlte::page')

@section('title', 'Edit Blacklisted Visitor')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Blacklisted Visitor</h2>

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
                <form action="{{ route('visitor_blacklist.update', $visitor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- B_id (ID) -->
                    <div class="mb-3">
                        <label for="B_id" class="form-label">B_id</label>
                        <input type="text" id="B_id" name="B_id" class="form-control" value="{{ old('B_id', $visitor->B_id) }}" required>
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
            
                    <!-- Reason for Blacklisting -->
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Blacklisting</label>
                        <textarea id="reason" name="reason" class="form-control" required>{{ old('reason', $visitor->reason) }}</textarea>
                    </div>
        
                    <!-- National ID -->
                    <div class="mb-3">
                        <label for="national_id" class="form-label">National ID</label>
                        <input type="text" id="national_id" name="national_id" class="form-control" value="{{ old('national_id', $visitor->national_id) }}">
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('visitor_blacklist') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>


    </div>
@endsection
