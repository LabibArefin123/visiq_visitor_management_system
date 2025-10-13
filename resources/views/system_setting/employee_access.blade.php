@extends('adminlte::page')

@section('title', 'Employee Access')

@section('content_header')
    <h1>Employee Access</h1>
@stop

@section('content')
    <div class="container">
        <h3>Manage Employee Access</h3>
        <p>Control access permissions for employees in the Visitor Management System.</p>

        <!-- Example Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Role</th>
                    <th>Access Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Manager</td>
                    <td>Full Access</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Revoke</button>
                    </td>
                </tr>
                <!-- Add more rows dynamically -->
            </tbody>
        </table>
    </div>
@stop
