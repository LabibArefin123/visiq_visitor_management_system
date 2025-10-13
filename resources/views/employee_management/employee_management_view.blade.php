@extends('adminlte::page')

@section('title', 'View Employee')

@section('content')
<div class="container">
    <h2>View Employee</h2>

    <div class="card mt-3">
        <div class="card-header">
            <h4>{{ $employee->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $employee->id }}</p>
            <p><strong>Name:</strong> {{ $employee->name }}</p>
            <p><strong>Age:</strong> {{ $employee->age }}</p>
            <p><strong>Department:</strong> {{ $employee->department }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('employee_management') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@stop