<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }

        .container {
            padding: 20px;
            border: 2px solid #000;
        }

        .header {
            text-align: center;
        }

        img {
            width: 120px;
            height: 120px;
            border: 2px solid #000;
            object-fit: cover;
        }

        .info {
            margin-top: 20px;
            font-size: 16px;
        }

        .info strong {
            width: 150px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <h2>Visitor Identification Card</h2>
            <img src="{{ $card->holder->photo ? asset($card->holder->photo) : asset('images/default.jpg') }}"
                alt="Photo">

        </div>

        <div class="info">
            <p><strong>Card Number:</strong> {{ $card->card_number }}</p>
            <p><strong>Holder Name:</strong> {{ $card->holder->name }}</p>

            <p><strong>Start Date:</strong>
                {{ \Carbon\Carbon::parse($card->issue_date)->format('d F Y') }}
            </p>

            <p><strong>Expiry Date:</strong>
                {{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}
            </p>

            <p><strong>Status:</strong> {{ ucfirst($card->status) }}</p>
            <p><strong>Remarks:</strong> {{ $card->remarks ?? 'N/A' }}</p>
        </div>

    </div>

</body>

</html>
