@extends('adminlte::page')

@section('title', 'View Admin User')

@section('content')
    <div class="container">
        <h2>View Admin User</h2>

        <div class="card">
            <div class="card-body">
                <h4>Name: {{ $admin->name }}</h4>
                <p>Email: {{ $admin->email }}</p>
                <p>Roles: {{ $admin->roles->pluck('name')->join(', ') }}</p>
                <!-- Add more details as needed -->
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin_user.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin_user.downloadPdf', $admin->id) }}" class="btn btn-primary">Download PDF</a>
            <a href="{{ route('admin_user.downloadWord', $admin->id) }}" class="btn btn-secondary">Download Word</a>
        </div>
    </div>
@stop

@section('footer')
    <div style="position: fixed; bottom: 5px; right: 5px; text-align: middle;">
        <p class="text-muted medium">
            Design and Developed by
            <a href="https://www.totalofftec.com" target="_blank" style="color: #007bff;">TOTALOFFTEC</a>
        </p>
    </div>
@endsection
