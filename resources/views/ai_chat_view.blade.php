@extends('adminlte::page')

@section('title', 'Chat View')

@section('content')
    <div class="container">
        <h2>Chat Details</h2>
        <a href="{{ route('ai.chat.list') }}" class="btn btn-secondary mb-3">Back to Chat List</a>

        <div class="card">
            <div class="card-body">
                <h5>Chat ID: {{ $chat->chat_id }}</h5>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($chat->chat_date)->format('Y-m-d h:i A') }}</p>
                
                <div class="border p-3" style="background: #f8f9fa; max-height: 400px; overflow-y: auto;">
                    {!! $chat->chat_content !!}
                </div>

                <a href="{{ route('ai.chat.download', $chat->id) }}" class="btn btn-success mt-3">Download PDF</a>
            </div>
        </div>
    </div>
@endsection
