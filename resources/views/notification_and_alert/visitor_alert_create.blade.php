@extends('adminlte::page')

@section('title', 'Create Visitor Alert')

@section('content')
<div class="container">
    <h2>Create Visitor Alert</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('visitor_alerts.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="info">Info</option>
                <option value="warning">Warning</option>
                <option value="danger">Danger</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-2">Create Alert</button>
    </form>
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