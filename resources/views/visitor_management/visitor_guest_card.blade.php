<!DOCTYPE html>
<html>
<head>
    <title>Guest Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .guest-card {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            display: inline-block;
            text-align: center;
            width: 350px;
        }
        .barcode {
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #ff9900;
        }
    </style>
</head>
<body>
    <div class="guest-card">
        <h2>Guest Card</h2>
        <div class="barcode">
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('GUEST_CARD', 'QRCODE', 6, 6) }}" alt="Guest Barcode" width="300" height="300">
        </div>
        <p>Designed & Developed by</p>
        <div class="footer">
            <p><strong>TOTALOFFTEC</strong></p>
        </div>
    </div>
</body>
</html>
