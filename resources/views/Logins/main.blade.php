<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
</head>
<body>
    <div class="container">
        <div class="AdminLogin">
            <button id="AdminId">Admin Login</button>
        </div>
        <div class="StudentLogin">
            <button id="StudentId">Student Login</button>
        </div>
        <div class="SecurityLogin">
            <button id="SecurityId">Security Login</button>
        </div>
    </div>
    <script>
        document.getElementById('AdminId').addEventListener('click', function() {
            window.location.href = "{{route('AdminLogin')}}";
        });
        document.getElementById('StudentId').addEventListener('click', function() {
            window.location.href = "{{route('StudentLogin')}}";
        });
        document.getElementById('SecurityId').addEventListener('click', function() {
            window.location.href = "{{route('SecurityLogin')}}";
        });
    </script>
</body>
</html>