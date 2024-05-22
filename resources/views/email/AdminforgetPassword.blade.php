<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    justify-content: center;
    align-items: center;
    height: 100%;">
<div class="container" style="text-align: center;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;">
        <div class="logo-container" style="margin-bottom: 20px;"> 
            <img src="https://www.nitpy.ac.in/assets/images/logo.png" alt="Logo" class="logo" style="max-width: 150px;">
        </div>
        <div class="description" style="margin-bottom: 20px;">
            <h1 style="font-family: sans-serif;">Password Reset</h1>
            <p style="    color: gray;
    font-weight: 600;
    font-size: small;
    font-family: system-ui;">If you have lost your password or wish to reset it, please click on the link below.</p>
        </div>
        <div class="reset-link" style="display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #006dff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;">
            <a style="color:white;text-decoration:none;" href="{{ route('admin-reset.password.get', $token) }}">Reset Your Password</a>
        </div>
        <div>
            <p style="    color: gray;
    font-weight: 500;
    font-size: small;
    font-family: system-ui;">If you did not request a password reset, you can safely ignore this email. Only a person with access to your email can reset your account password.</p>
        </div>
    </div>
</body>
</html>