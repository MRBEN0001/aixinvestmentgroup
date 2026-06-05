<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body>
    <h2>Your OTP Code</h2>
    <p>Your One-Time Password (OTP) is: <strong>{{ $otp }}</strong></p>
    <p>Use this code to complete your login process.</p>
    <p>If you did not request this, please ignore this message.</p>
</body>
</html>
