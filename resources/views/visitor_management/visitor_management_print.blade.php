<!DOCTYPE html>
<html>
<head>
    <title>Print Visitor Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include any required CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .visitor-card {
            text-align: center;
            background-color: #fffff2;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
        }
        .visitor-card h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .visitor-card p {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }
        .barcode {
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 16px;
            color: #777;
        }
        .footer strong {
            display: block;
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="visitor-card">
        <h2>Visitor Details</h2>
        <p><strong>ID:</strong> {{ $visitor->id }}</p>
        <p><strong>Name:</strong> {{ $visitor->name }}</p>
        <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
        <p><strong>Visit Purpose:</strong> {{ $visitor->purpose }}</p>
        <p><strong>Visit Date:</strong> {{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d') }}</p>
        <p><strong>Date of Birth:</strong> {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>Age:</strong> 
            @if ($visitor->date_of_birth)
                {{ \Carbon\Carbon::parse($visitor->date_of_birth)->age }}
            @else
                N/A
            @endif
        </p>
        <p><strong>National ID:</strong> {{ $visitor->national_id ?? 'N/A' }}</p>
        <p><strong>Gender:</strong> {{ $visitor->gender ?? 'N/A' }}</p>
        <p><strong>Visitor Type:</strong> {{ $visitor->visitor_type ?? 'Single' }}</p>

        <div class="barcode">
            <!-- Placeholder for Barcode -->
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG((string) $visitor->id, 'QRCODE', 5, 5) }}" alt="Barcode" width="300" height="300">

        </div>

        <div class="footer">
            Designed & Developed by
            <strong>TOTALOFFTEC</strong>
        </div>
    </div>
</body>
</html>
