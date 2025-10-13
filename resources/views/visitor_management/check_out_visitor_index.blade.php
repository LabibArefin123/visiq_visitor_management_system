@extends('adminlte::page')

@section('title', 'Check-Out Visitor')

@section('content')
<div class="container">
    <h2>Check-Out Visitor</h2>

    <!-- Visitor Check-Out Form -->
    <div class="mb-3 text-right">
        <a href="{{ route('checkout_visitor_manual') }}" class="btn btn-primary">Manual Check-Out</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>VID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Purpose</th>
                <th>Check-Out Time</th>
                <th>Total Check-Outs</th> <!-- Added Total Check-Outs Column -->
            </tr>
        </thead>
        <tbody>
            @forelse ($checkOutVisitors as $checkout)
                <tr>
                    <td>{{ $checkout->id }}</td>
                    <td>{{ $checkout->visitor->v_id }}</td>
                    <td>{{ $checkout->visitor->name }}</td> <!-- Fetch name from visitor relationship -->
                    <td>{{ $checkout->age }}</td>
                    <td>{{ $checkout->visitor->purpose }}</td> <!-- Fetch purpose from visitor relationship -->
                    <td>{{ \Carbon\Carbon::parse($checkout->check_out_time)->format('Y-m-d h:i A') }}</td> <!-- Formatted Time -->
                    <td>{{ $checkout->total_checkouts }}</td> <!-- Show Total Check-Outs -->
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No visitors found for check-out.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="container mt-3">
        <h5>Total Check-Outs: {{ $totalCheckouts }}</h5>
    </div>
</div>
@stop

