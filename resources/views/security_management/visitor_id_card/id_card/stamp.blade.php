<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            size: A4 portrait;
            margin: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #f4f4f4;
        }

        /* Center on A4 */
        .page-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card Box */
        .id-card {
            width: 360px;
            padding: 18px;
            background: white;
            border: 2px solid #000;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }

        /* Circular photo container */
        .photo-box {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            border: 2px solid #000;
            overflow: hidden;
            margin: 0 auto 10px auto;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Headings */
        h2 {
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: bold;
        }

        h3 {
            margin: 5px 0 8px 0;
            font-size: 12px;
            font-weight: bold;
        }

        /* Labels and values */
        .label {
            font-size: 10px;
            font-weight: bold;
            margin-top: 4px;
        }

        .value {
            font-size: 10px;
            margin-bottom: 2px;
        }

        /* Start & Expiry in row */
        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            padding: 0 8px;
        }

        .col {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="page-container">
        <div class="id-card">

            <h2>Visitor ID Card</h2>

            <div class="photo-box">
                <img src="{{ public_path('images/default.jpg') }}" alt="Photo">
            </div>

            <h3>Visitor ID: {{ $card->card_number }}</h3>

            <div class="label">Name</div>
            <div class="value">{{ $card->holder->name }}</div>

            <div class="row">
                <div class="col">
                    <div class="label">Start Date</div>
                    <div class="value">{{ \Carbon\Carbon::parse($card->issue_date)->format('d M Y') }}</div>
                </div>

                <div class="col">
                    <div class="label">Expiry Date</div>
                    <div class="value">{{ \Carbon\Carbon::parse($card->expiry_date)->format('d M Y') }}</div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
