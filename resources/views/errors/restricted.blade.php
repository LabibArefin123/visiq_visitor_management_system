@extends('layouts.app')

@section('title', 'Restricted Access')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="text-danger">Access Restricted</h1>
        <p>You are restricted to visit this page. Please contact the administrator if you believe this is an error.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>
@endsection
