<!DOCTYPE html>
<html>
<head>
    <title>Login OTP</title>
</head>
<body style="font-family: sans-serif; text-align: center; padding: 20px;">
    <h1>{{ get_setting('site_title', 'ChatterGlow') }} Login</h1>
    <p>Your OTP for login is:</p>
    <h2 style="font-size: 32px; color: #FF4500; letter-spacing: 5px;">{{ $otp }}</h2>
    <p>This OTP is valid for 10 minutes.</p>
</body>
</html>
