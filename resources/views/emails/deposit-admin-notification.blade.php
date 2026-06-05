<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">

    <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="padding: 30px 0; text-align: center; background-color: #0c1c46;">
                <h1 style="color: #ffffff; margin: 0;">{{ config('app.name') }}</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <table role="presentation" cellspacing="0" cellpadding="0" width="100%" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color: #0c1c46; font-size: 20px; margin-bottom: 20px;">New Deposit Notification</h2>

                            <p style="margin: 10px 0;"><strong>Name:</strong> {{ $data['name'] }}</p>
                            <p style="margin: 10px 0;"><strong>Email:</strong> {{ $data['email'] }}</p>
                            <p style="margin: 10px 0;"><strong>Account Number:</strong> {{ $data['account_number'] }}</p>
                            <p style="margin: 10px 0;"><strong>Amount:</strong> ${{ number_format($data['amount'], 2) }}</p>
                            <p style="margin: 10px 0;"><strong>Transaction Hash:</strong> {{ $data['reference'] }}</p>

                            <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">

                            <p style="margin: 0; font-size: 14px; color: #555;">
                                Please log in to the admin panel to review and confirm the transaction.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0; text-align: center; font-size: 12px; color: #aaa;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
