@extends('adminlte::page')

@section('content')
    <div class="container text-center">
        <h2>Visitor Check-In</h2>
        <p>Name: {{ $visitor->name }}</p>
        <p>Phone: {{ $visitor->phone }}</p>
        <p>Email: {{ $visitor->email ?? 'N/A' }}</p>
        <p>National ID: {{ $visitor->national_id ?? 'N/A' }}</p>
        <p>Status: Checked In</p>
    </div>
@endsection
