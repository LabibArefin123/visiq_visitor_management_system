@extends('adminlte::page')

@section('title', 'Send Notification')

@section('content')
<div class="container">
    <h2>Send Notification</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('visitor_alerts.notify.send') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="visitor_id">Select Visitor</label>
            <select class="form-control" name="visitor_id" required>
                <option value="">-- Select a Visitor --</option>
                @foreach($visitors as $visitor)
                    <option value="{{ $visitor->id }}">{{ $visitor->name }} (ID: {{ $visitor->v_id }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Notification Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Send Notification</button>
    </form>
</div>
@stop
