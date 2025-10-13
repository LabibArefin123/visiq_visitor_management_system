@extends('adminlte::page')

@section('title', 'AI Chat List')

@section('content')
    <div class="container">
        <h2>Saved AI Chats</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Chat ID</th>
                    <th>Chat Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $chat)
                    <tr>
                        <td>{{ $chat->chat_id }}</td>
                        <td>{{ $chat->chat_date }}</td>
                        <td>
                            <a href="{{ route('ai.chat.view', $chat->id) }}" class="btn btn-info btn-sm view-chat-btn">View</a>
                            <a href="{{ route('ai.chat.download', $chat->id) }}" class="btn btn-success btn-sm download-pdf-btn">Download PDF</a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle "View" button
            document.querySelectorAll('.view-chat-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let url = this.getAttribute('href');

                    Swal.fire({
                        title: "View Chat?",
                        text: "Do you want to open this chat?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

            // Handle "Download PDF" button
            document.querySelectorAll('.download-pdf-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let url = this.getAttribute('href');

                    Swal.fire({
                        title: "Download PDF?",
                        text: "Do you want to download this chat as a PDF?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>

@endsection
