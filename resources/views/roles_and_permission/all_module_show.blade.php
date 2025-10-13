@extends('adminlte::page')

@section('title', 'Show Module')
@section('content')
    <div class="container">
        <h1>Module Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $module->name }}</h5>
                <p class="card-text">{{ $module->description }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $module->status }}</p>
            </div>
        </div>
        <a href="{{ route('modules.index') }}" class="btn btn-secondary mt-3">Back to All Modules</a>
    </div>
@endsection
