<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }
    </style>
</head>
<body>
<h1>Login</h1>
    <form method="post" action="/login" id="login">
        @csrf
        <input type="text" name="rollno" placeholder="Roll Number">
        <br><br>
        <input type="password" id="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="Submit" id="submit" value="Submit">
</body>
</html>