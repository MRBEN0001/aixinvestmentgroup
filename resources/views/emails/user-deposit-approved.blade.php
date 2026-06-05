<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Deposit Approved</title>
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
                            <h2 style="color: #0c1c46; font-size: 20px; margin-bottom: 20px;">
                                <h2>Hello {{ $data['name'] }},</h2>



                                <p>Your deposit of <strong>${{ number_format($data['amount'], 2) }}</strong> has been successfully approved.</p>
                                <p><strong>Reference:</strong> {{ $data['reference'] }}</p>
                                <p><strong>Approved At:</strong> {{ $data['approved_at'] }}</p>


                                <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">

                                <p style="margin: 0; font-size: 14px; color: #555;">
                                    Thank you for banking with us.
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