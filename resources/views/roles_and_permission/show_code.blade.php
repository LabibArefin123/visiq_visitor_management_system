@extends('adminlte::page')

@section('title', 'Show Permission Code')

@section('content')
    <div class="container">
        <h1 class="mb-4">Full Code for Permission: {{ $permission->name }}</h1>

        @if($code)
            <h3>Route Code:</h3>
            <pre><code>{{ $code['route'] }}</code></pre>
            
            <h3>Controller Code:</h3>
            <pre><code>{{ $code['controller'] }}</code></pre>

            <h3>Blade File:</h3>
            <pre><code>{{ $code['blade'] }}</code></pre>
        @else
            <p>No code available for this permission.</p>
        @endif

        <a href="{{ route('permissions.index') }}" class="btn btn-primary mt-3">Back to Permissions</a>
    </div>
@endsection
