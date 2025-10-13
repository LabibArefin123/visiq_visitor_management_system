@extends('adminlte::page')

@section('title', 'Visitor Log')
@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Visitor Log</h2>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Download Blank Form</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <p>Do you want to download a blank form by PDF?</p>
                        <a href="{{ route('visitor_blank_pdf') }}" class="btn btn-primary">Download PDF</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <p>Do you want to download a blank form by Word?</p>
                        <a href="{{ route('visitor_blank_word') }}" class="btn btn-primary">Download Word</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inviteCodeModal">
                Add Invite Code
            </button>
            <a href="{{ route('checkin_visitor_manual') }}" class="btn btn-warning">Manual Check-In</a>
            <a href="{{ route('guest_card') }}" class="btn btn-danger">Add Guest Card</a>
           
        </div>

        <div class="modal fade" id="inviteCodeModal" tabindex="-1" aria-labelledby="inviteCodeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="inviteCodeModalLabel">Generate Invite QR Code</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="inviteCodeForm">
                            @csrf
                            <div class="row">
                                <!-- Name Field -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Enter visitor's name" required>
                                    </div>
                                </div>
                                <!-- Phone Field -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="Enter phone number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Purpose Field -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="purpose">Purpose</label>
                                        <input type="text" id="purpose" name="purpose" class="form-control"
                                            placeholder="Enter visit purpose" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success" onclick="generateQRCode()">Generate QR
                                    Code</button>
                            </div>
                        </form>
                        <!-- QR Code Display -->
                        <div class="text-center mt-4">
                            <div id="qrCodeContainer" class="border p-3 rounded" style="display: none;">
                                <h5 class="mb-3">Scan this QR Code</h5>
                                <canvas id="qrCanvas"></canvas>
                                <p class="text-danger mt-3">This QR code is valid for 30 minutes and can only be used once.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Visit Purpose</th>
                        <th>Visit Date</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>National ID</th>
                        <th>Gender</th>
                       
                        <th style="min-width: 200px; white-space: nowrap;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{{ $visitor->v_id }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->phone }}</td>
                            <td>{{ $visitor->email ?? 'N/A' }}</td>
                            <td>{{ $visitor->purpose }}</td>
                            <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') }}</td>
                            <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                @if ($visitor->date_of_birth)
                                    {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $visitor->national_id ?? 'N/A' }}</td>
                            <td>{{ $visitor->gender ?? 'N/A' }}</td>
                           
                            <td class="text-nowrap text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('visitor.view', $visitor->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('visitor_log_edit', $visitor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $visitor->id }}">Delete</button>
                                    <a href="{{ route('visitor.print', $visitor->id) }}" class="btn btn-secondary btn-sm">Print</a>
                                </div>
        
                                <!-- Hidden Delete Form -->
                                <form id="delete-form-{{ $visitor->id }}" action="{{ route('visitor.delete', $visitor->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Total Visitors Count Display -->
        <div class="mt-3">
            <h5 class="text-center">Total Visitors: <span class="badge badge-primary">{{ $totalVisitors }}</span></h5>
        </div>
        
        
        
        <!-- Include SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            function confirmAction(action, visitorId) {
                let messages = {
                    'view': { title: "View Visitor", text: "Do you want to view this visitor's details?", icon: "info", url: "{{ route('visitor.view', '') }}/" + visitorId },
                    'edit': { title: "Edit Visitor", text: "Do you want to edit this visitor?", icon: "question", url: "{{ route('visitor.update', '') }}/" + visitorId },
                    'delete': { title: "Are you sure?", text: "This action cannot be undone!", icon: "warning", url: "{{ route('visitor.delete', '') }}/" + visitorId, confirmText: "Yes, delete it!", confirmColor: "#d33" },
                    'print': { title: "Print Visitor", text: "Do you want to print this visitor's details?", icon: "success", url: "javascript:printVisitor(" + visitorId + ")" }
                };
        
                let config = messages[action];
        
                Swal.fire({
                    title: config.title,
                    text: config.text,
                    icon: config.icon,
                    showCancelButton: true,
                    confirmButtonColor: config.confirmColor || "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: config.confirmText || "Yes, proceed!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (action === 'print') {
                            eval(config.url); // Calls printVisitor(visitorId) directly
                        } else {
                            window.location.href = config.url;
                        }
                    }
                });
            }
        </script>
        
        

    </div>
@stop


<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function generateQRCode() {
        // Fetch form values
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const purpose = document.getElementById('purpose').value;

        // Validate form inputs
        if (!name || !phone || !purpose) {
            alert('Please fill out all fields.');
            return;
        }

        // Send data to the backend to generate QR code
        fetch('{{ route('generate_temp_qr') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    name,
                    phone,
                    purpose
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
                    const qrCanvas = document.getElementById('qrCanvas');

                    // Generate and display the QR code
                    qrCodeContainer.style.display = 'block';
                    QRCode.toCanvas(qrCanvas, data.code, {
                        width: 200
                    }, function(error) {
                        if (error) console.error(error);
                    });

                    // Close the modal automatically after generating the QR code
                    const modal = document.getElementById('inviteCodeModal');
                    const bootstrapModal = bootstrap.Modal.getInstance(modal);
                    bootstrapModal.hide();

                    // Show success notification
                    const showSuccessNotification = (message) => {
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success';
                        alertDiv.innerText = message;
                        document.body.prepend(alertDiv);

                        setTimeout(() => alertDiv.remove(), 3000);
                    };

                    // Display success message
                    showSuccessNotification('QR Code generated successfully!');
                } else {
                    alert('Error generating QR code: ' + data.message);
                }
            })
            .catch((error) => console.error('Error:', error));
    }

    // Optional QR code scan event handling (simulating QR code scan)
    document.addEventListener('DOMContentLoaded', () => {
        const qrCodeContainer = document.getElementById('qrCodeContainer');

        if (qrCodeContainer) {
            window.addEventListener('qrScanComplete', (event) => {
                const url = event.detail; // Simulated scanned URL
                fetch(url)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            const tableBody = document.querySelector('tbody');
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = `
                            <td>${data.visitor.id}</td>
                            <td>${data.visitor.name}</td>
                            <td>${data.visitor.phone}</td>
                            <td>${data.visitor.purpose}</td>
                            <td>${new Date(data.visitor.visit_date).toLocaleDateString()}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        `;
                            tableBody.appendChild(newRow);

                            // Optionally, show a success notification here
                            showSuccessNotification('Visitor added successfully!');
                        }
                    })
                    .catch((error) => {
                        console.error('QR code processing error:', error);
                    });
            });
        }
    });
</script>
<script>
    function printVisitor(visitorId) {
        const printUrl = `{{ url('/visitor/print') }}/${visitorId}`;
        const printWindow = window.open(printUrl, '_blank');
        printWindow.print();
    }
</script>
@section('css')
    <link rel="stylesheet" href="{{ asset('css/customs.css') }}">
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
</script>

