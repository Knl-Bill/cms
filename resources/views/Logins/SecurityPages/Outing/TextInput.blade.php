<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outing Registration</title>
    <link rel="stylesheet" href="assets/css/SecurityOuting.css">
</head>
<body>
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="/InsertOuting" method="POST">
            @csrf
            <label for="student">Enter a Roll No: - </label><br>
            <input type="text" name="rollno" required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <br><br>
    <div class="ButtonContainer">
        <div class="OutingStatus">
            <button id="OutingStatus">Outing Status</button>
        </div>
        <div class="Unclosed Outings">
            <button id="UnclosedOuting">Unclosed Outings</button>
        </div>
        <div class="BoysOuting">
            <button id="BoysOuting">Boys Outing</button>
        </div>
        <div class="GirlsOuting">
            <button id="GirlsOuting">Girls Outing</button>
        </div>
    </div>
    <script>
        document.getElementById('OutingStatus').addEventListener('click', function() {
            window.location.href = '{{route('OutingStatus')}}';
        });

        document.getElementById('UnclosedOuting').addEventListener('click', function() {
            window.location.href = '{{route('UnclosedOuting')}}';
        });

        document.getElementById('BoysOuting').addEventListener('click', function() {
            window.location.href = '{{route('BoysOuting')}}';
        });

        document.getElementById('GirlsOuting').addEventListener('click', function() {
            window.location.href = '{{route('GirlsOuting')}}';
        });
    </script>
</body>
</html>