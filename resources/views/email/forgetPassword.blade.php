<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Forget Password Email</h1>
   
   You can reset password from below link:
   <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
</body>
</html>