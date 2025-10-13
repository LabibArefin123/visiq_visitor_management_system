<!DOCTYPE html>
<html>
<head>
    <title>Visitor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Visitor Details</h2>
    <p><strong>Name:</strong> {{ $visitor->name }}</p>
    <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
    <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
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
</body>
</html>
