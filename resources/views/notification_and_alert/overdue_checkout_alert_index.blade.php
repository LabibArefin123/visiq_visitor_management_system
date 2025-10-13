@extends('adminlte::page')

@section('title', 'Overdue Check-Out Alerts')

@section('content')
<div class="container">
    <h2>Overdue Check-Out Alerts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Overdue Visitors Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Phone</th>
                <th>Check-In Time</th>
                <th>Expected Check-Out Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($overdueEmployees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->check_in_time }}</td>
                    <td class="text-danger">{{ $employee->expected_checkout_time }}</td>
                    <td>
                        <form action="{{ route('notifications.notifyOverdue', $employee->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Notify</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No overdue visitor/employee found.</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
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