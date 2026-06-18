<!DOCTYPE html>
<html>
<head>
    <title>Withdrawal Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Black background */
            color: #FFD700; /* Gold (yellow) text */
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            background-color: #111; /* Slightly lighter black */
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        h5 {
            color: #FFD700; /* Gold (yellow) */
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .details {
            background-color: #222;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .button {
            display: inline-block;
            background-color: #FFD700; /* Gold button */
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #bbb;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 15px;
            }
            p, h2 {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h5>Withdrawal Confirmation</h5>
        <p>Dear {{ $data['name'] }},</p>
        <p>Your withdrawal request has been received and is being processed.</p>

        <div class="details">
            <p><strong>Amount:</strong> ${{ $data['amount'] }}</p>
            <p><strong>Coin:</strong> {{ $data['coin'] }}</p>
            <p><strong>Wallet Address:</strong> {{ $data['wallet_address'] }}</p>
        </div>

        <p>Thank you for choosing us</p>

        <a href="" class="button"> {{ config('app.name') }}</a>

        {{-- <div class="footer">
            Thanks, <br>
            {{ config('app.name') }}
        </div> --}}
    </div>

</body>
</html>
