<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Application Received</title>
    <style>
        body {
            background-color: #000;
            color: #dbc8a8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 600px;
            margin: auto;
            border: 1px solid #dbc8a8;
            padding: 30px;
            border-radius: 8px;
            background-color: #111;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-height: 60px;
        }
        h2 {
            color: #dbc8a8;
            border-bottom: 1px solid #dbc8a8;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        ul {
            padding-left: 0;
            list-style: none;
        }
        ul li {
            margin-bottom: 12px;
            padding: 10px;
            background: #1a1a1a;
            border-left: 4px solid #dbc8a8;
            border-radius: 4px;
        }
        ul li strong {
            color: #dbc8a8;
            display: inline-block;
            width: 140px;
        }
        .footer-note {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="logo">
            <img src="https://dev.wave-69.co.uk/model-mayfair/public/storage/images/logo.svg" alt="Logo">
        </div>

        <h2>New Casting Received</h2>

        <ul>
            @foreach($data as $key => $value)
                <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> <strong>{{ $value }}</strong></li>
            @endforeach
        </ul>

        <
       
    </div>
</body>
</html>
