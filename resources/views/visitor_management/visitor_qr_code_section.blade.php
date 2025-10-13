<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor QR Code</title>
</head>
<body>
    <div style="text-align: center;">
        <h3>{{ $visitor->name }}</h3>

        <p><strong>Visitor ID:</strong> {{ $visitor->v_id }}</p>
        <p><strong>National ID:</strong> {{ $visitor->national_id ?? 'N/A' }}</p>
        <p><strong>Age:</strong> {{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age : 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
        <p><strong>Email:</strong> {{ $visitor->email ?? 'N/A' }}</p>

        <div>
            <img src="{{ $dataUri }}" alt="QR Code" />
        </div>

        <div style="margin-top: 30px;">
            <strong>Design and Developed by TOTALOFFTEC</strong>
        </div>
    </div>
</body>
</html>
