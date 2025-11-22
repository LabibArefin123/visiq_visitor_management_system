<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 10px;
            font-family: sans-serif;
        }

        .card-box {
            width: 100%;
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
        }

        img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            border: 1px solid #000;
            object-fit: cover;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .label {
            font-weight: bold;
            font-size: 12px;
        }

        .value {
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="card-box">

        <img src="{{ $card->holder->photo ? asset($card->holder->photo) : asset('images/default.jpg') }}" alt="Photo">

        <h3 style="margin: 5px 0;">Visitor ID: {{ $card->card_number }}</h3>

        <div class="label">Name:</div>
        <div class="value">{{ $card->holder->name }}</div>

        <div class="row">
            <div>
                <div class="label">Start Date</div>
                <div class="value">{{ \Carbon\Carbon::parse($card->issue_date)->format('d F Y') }}</div>
            </div>

            <div>
                <div class="label">Expiry Date</div>
                <div class="value">{{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}</div>
            </div>
        </div>

    </div>

</body>

</html>
