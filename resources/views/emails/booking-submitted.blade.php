<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking Request</title>
    <style>
        body {
            background-color: #000;
            color: #dbc8a8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .email-container {
            max-width: 620px;
            margin: auto;
            background-color: #111;
            border: 1px solid #dbc8a8;
            padding: 30px;
            border-radius: 8px;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            max-height: 60px;
        }

        h2 {
            border-bottom: 1px solid #dbc8a8;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .info-row {
            margin-bottom: 14px;
            padding: 10px;
            background-color: #1a1a1a;
            border-left: 4px solid #dbc8a8;
            border-radius: 4px;
        }

        .info-row strong {
            color: #dbc8a8;
            display: inline-block;
            width: 160px;
        }

        .info-row span {
            color: #fff;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 13px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="https://dev.wave-69.co.uk/model-mayfair/public/storage/images/logo.svg" alt="Logo">
        </div>

        <h2>New Booking Request</h2>

        <div class="info-row">
            <strong>Escort:</strong> <span>{{ $data['escort_name'] ?? 'N/A' }}</span>
        </div>

        <div class="info-row">
            <strong>Date:</strong> <span>{{ $data['booking_date'] }}</span>
        </div>

        <div class="info-row">
            <strong>Time:</strong> <span>{{ $data['booking_time'] }}</span>
        </div>

        <div class="info-row">
            <strong>Duration:</strong> <span>{{ $data['duration'] }}</span>
        </div>

        <div class="info-row">
            <strong>Address:</strong> <span>{{ $data['address'] }}</span>
        </div>

        <div class="info-row">
            <strong>Full Name:</strong> <span>{{ $data['full_name'] }}</span>
        </div>

        <div class="info-row">
            <strong>Contact Number:</strong> <span>{{ $data['contact_number'] }}</span>
        </div>

        <div class="info-row">
            <strong>Email:</strong> <span>{{ $data['contact_email'] }}</span>
        </div>

        <div class="info-row">
            <strong>Services:</strong> <span>{{ $data['notes'] ?? 'None' }}</span>
        </div>

        
    </div>
</body>
</html>
