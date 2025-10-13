@extends('adminlte::page')

@section('title', 'View User')

@section('content')
    <div class="container">
        <h2>User Details</h2>

        <div>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'Not Provided' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'Not Provided' }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($user->gender) ?? 'Not Provided' }}</p>
            <p><strong>Marital Status:</strong> {{ ucfirst($user->marital_status) ?? 'Not Provided' }}</p>
        </div>

        <a href="{{ route('all_users') }}" class="btn btn-primary">Back to Users</a>
    </div>
@stop
