@extends('adminlte::page')

@section('title', 'Approval Status')

@section('content')
<div class="container">
    <h2>Approval Status</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($statusRecords as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->phone }}</td>
                    <td>{{ $record->purpose }}</td>
                    <td>{{ ucfirst($record->status) }}</td>
                    <td>{{ $record->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No approval status records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
