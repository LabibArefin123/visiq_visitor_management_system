@extends('adminlte::page')

@section('title', 'Visitor QR Code')
@section('content')
    <div class="container text-center">
        <h1>QR Code for {{ $visitor->name }}</h1>
        <div>
            <img src="{{ $qrCodePath }}" alt="QR Code for {{ $visitor->name }}">
        </div>
        <a href="{{ route('visitor_management') }}" class="btn btn-secondary mt-3">Back to Visitor List</a>
    </div>
@endsection