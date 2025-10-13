@extends('adminlte::page')

@section('title', 'AI Chat')

@section('content')
    <div class="container">
        <h2>AI Chat</h2>
        <p>Ask me anything!</p>

        <div class="card">

            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('ai.chat.list') }}" class="btn btn-primary" id="chat-list-btn">Chat List</a>
                </div>

                <div id="chat-box" class="border p-3 mb-3" style="height: 450px; overflow-y: auto; background: #f8f9fa;">
                </div>

                <div class="input-group">
                    <input type="text" id="chat-input" class="form-control" placeholder="Type your message...">
                    <div class="input-group-append">
                        <button id="send-btn" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('chat-list-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            Swal.fire({
                title: "Go to Chat List?",
                text: "Do you want to proceed to the chat list?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('ai.chat.list') }}"; // Redirect if user clicks "Yes"
                }
            });
        });
        document.getElementById('send-btn').addEventListener('click', function() {
            let message = document.getElementById('chat-input').value;
            if (!message.trim()) return;

            let chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += `<p><strong>You:</strong> ${message}</p>`;
            document.getElementById('chat-input').value = '';

            // Add loading indication
            chatBox.innerHTML += `<p><strong>AI:</strong> Loading...</p>`;
            chatBox.scrollTop = chatBox.scrollHeight;

            fetch("{{ route('ai.chat.response') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let lastMessage = chatBox.lastElementChild;
                    if (lastMessage && lastMessage.textContent.includes('Loading...')) {
                        lastMessage.innerHTML = `<strong>AI:</strong> ${data.response}`;
                    }

                    chatBox.scrollTop = chatBox.scrollHeight;

                    // If the user says "bye", save and download PDF
                    if (message.toLowerCase() === "bye") {
                        setTimeout(() => {
                            let confirmSave = confirm("Do you want to save this chat?");
                            if (confirmSave) {
                                fetch("{{ route('ai.chat.store') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            chat_content: chatBox.innerHTML
                                        })
                                    })
                                    .then(response => response.json())

                            }
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    chatBox.innerHTML += `<p><strong>AI:</strong> Sorry, I could not process your request.</p>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        });
    </script>

@endsection
