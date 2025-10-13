@extends('adminlte::page')

@section('title', 'View All Routes')

@section('content')
<div class="container">
    <h2>All Routes</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Route Name</th>
                <th>Route URI</th>
                <th>Access</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routeList as $index => $route)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $route['name'] ?? 'N/A' }}</td>
                    <td>{{ $route['uri'] }}</td>
                    <td>
                        <input type="checkbox" {{ auth()->user()->hasPermissionTo($route['action']) ? 'checked' : '' }} disabled>
                    </td>
                </tr>
            @endforeach
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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

