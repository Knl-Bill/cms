<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request For Leave</title>
    <style>
        body{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }
    </style>
    <link rel="stylesheet" href="assets/css/login_signup.css">
</head>
<body>
    <h1>Leave Request</h1>
    <br><br>
    <div class="status">
        <a href="{{ route('leavereqshist') }}">See Your Leave Status</a>
    </div>
    <br><br>
    @if (Session::get('success'))
        <span class="text-safe" role="alert">
            {{ Session::get('success') }}
        </span>
    @endif
    <form method="post" action="/InsertLeaveRequest" id="leavereq" enctype="multipart/form-data">
        @csrf
        <label for="rollno">Roll No: - </label>
        <input class="disabled" disabled id="rollno" type="text" name="rollno" placeholder="Roll Number">
        <br><br>
        <label for="name">Name: - </label>
        <input class="disabled" disabled id="name" type="text" name="name" placeholder="Full Name (as in ID card)">
        <br><br>
        <label for="phoneno">Phone No: - </label>
        <input class="disabled" disabled id="phoneno" type="text" name="phoneno" placeholder="Phone Number">
        <br><br>
        <label for="placeofvisit">Place of Visit: - </label>
        <input type="text" name="placeofvisit" placeholder="Place Of Visit" required>
        <br><br>
        <label for="purpose">Purpose of Visit: - </label>
        <input type="text" name="purpose" placeholder="Purpose of Visit" required>
        <br><br>
        <label for="outdate">Out Date: - </label>
        <input type="text" name="outdate" placeholder="Out Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
        <br><br>
        <label for="outime">Out Time: - </label>
        <input type="text" name="outime" placeholder="Out Time" onfocus="(this.type='time')" onblur="(this.type='text')" required>
        <br><br>
        <label for="indate">In Date: - </label>
        <input type="text" name="indate" placeholder="In Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
        <br><br>
        <label for="intime">In Time: - </label>
        <input type="text" name="intime" placeholder="In Time" onfocus="(this.type='time')" onblur="(this.type='text')" required>
        <br><br>
        <label for="noofdays">No of Days: - </label>
        <input type="text" name="noofdays" placeholder="Number of Days" required>
        <br><br>
        <label for="image">Screenshot of E-Mail from Parents: - </label>
        <input type="text" placeholder="E-Mail Screenshot" accept="image/png,image/jpeg"  oninput="this.className = ''" name="image" onfocus="(this.type='file')">
        <br><br>
        <input type="Submit" id="submit" value="Submit" style="margin-left:55px">
        <br><br>
        <script>
            fetch('DisabledDetails').then(response => response.json()).then(data => {
                document.getElementById('rollno').value = data.rollno;
                document.getElementById('rollno').placeholder = data.rollno;

                document.getElementById('name').value = data.name;
                document.getElementById('name').placeholder = data.name;

                document.getElementById('phoneno').value = data.phoneno;
                document.getElementById('phoneno').placeholder = data.phoneno;
            })
        </script>
</body>
</html>

 