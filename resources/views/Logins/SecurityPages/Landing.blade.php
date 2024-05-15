<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <div>
        <div class="Outing">
            <button id="OutingId">Outing</button>
        </div>
        <div class="Leave">
            <button id="LeaveId">Leave</button>
        </div>
    </div>
    <script>
        document.getElementById('LeaveId').addEventListener('click', function() {
            window.location.href = '/Security/Leave';
        });
        document.getElementById('OutingId').addEventListener('click', function() {
            window.location.href = '/Security/Outing';
        })
    </script>
</body>
</html>