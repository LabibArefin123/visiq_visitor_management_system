<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Visitor ID Card</title>

    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Center card in full A4 page */
        .page-container {
            width: 100%;
            height: 100vh;
            padding-top: 80px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* Actual ID Card */
        .id-card {
            width: 340px;
            height: 220px;
            border: 2px solid #000;
            padding: 15px;
            border-radius: 12px;
            position: relative;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Circular photo */
        .photo-box {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 2px solid #000;
            overflow: hidden;
            float: left;
            margin-right: 15px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info {
            font-size: 13px;
            line-height: 1.3;
        }

        .label {
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            left: 15px;
            right: 15px;
            font-size: 12px;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>

</head>

<body>

    <div class="page-container">

        <div class="id-card">

            <div class="header">
                <h2>Visitor ID Card</h2>
            </div>

            <div class="photo-box">
                <img src="{{ public_path('images/default.jpg') }}" alt="Photo">
            </div>

            <div class="info">
                <p><span class="label">Name:</span> {{ $card->holder->name }}</p>
                <p><span class="label">Visitor ID:</span> {{ $card->holder->visitor_id }}</p>
                <p><span class="label">Phone:</span> {{ $card->holder->phone }}</p>
                <p><span class="label">Issue Date:</span>
                    {{ \Carbon\Carbon::parse($card->issue_date)->format('d M, Y') }}
                </p>
                <p><span class="label">Valid Till:</span>
                    {{ \Carbon\Carbon::parse($card->expiry_date)->format('d M, Y') }}
                </p>
            </div>

            <div class="footer">
                Authorized Signature
            </div>

        </div>

    </div>

</body>

</html>
