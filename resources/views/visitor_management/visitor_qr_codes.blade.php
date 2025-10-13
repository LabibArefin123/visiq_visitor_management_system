@extends('adminlte::page')

@section('title', 'Visitor QR Code Management')

@section('content')
    <div class="container">
        <h2 class="mb-4">Visitor QR Code Management</h2>

        <!-- QR Code Table -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">QR Code Table</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Visitor ID</th>
                            <th>National ID</th>
                            <th>Visitor Name</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->id }}</td>
                                <td>{{ $visitor->v_id }}</td>
                                <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                                <td>{{ $visitor->name }}</td>
                                <td>
                                    @if ($visitor->date_of_birth)
                                        {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('visitor.qr_code.pdf', $visitor->id) }}"
                                        class="btn btn-secondary btn-sm">
                                        Download PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- QR Code Sending Table -->
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Send QR Code</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Visitor ID</th>
                            <th>National ID</th>
                            <th>Visitor Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Send Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->id }}</td>
                                <td>{{ $visitor->v_id }}</td>
                                <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email }}</td>
                                <td>
                                    <button onclick="sendToWhatsApp({{ $visitor->id }})" class="btn btn-success btn-sm">
                                        Send to WhatsApp
                                    </button>
                                    <button onclick="sendToEmail({{ $visitor->id }})" class="btn btn-info btn-sm">
                                        Send to Email
                                    </button>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function sendToWhatsApp(visitorId) {
            fetch('{{ url('visitor/send-qr/whatsapp/') }}/' + visitorId)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Success' : 'Error',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
    <script>
        function sendToEmail(visitorId) {
            fetch('{{ url('visitor/send-qr/email/') }}/' + visitorId)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Success' : 'Error',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>

@endsection


<script>
    function printVisitor(visitorId) {
        const printUrl = `{{ url('/visitor/print') }}/${visitorId}`;
        const printWindow = window.open(printUrl, '_blank');
        printWindow.print();
    }
</script>
