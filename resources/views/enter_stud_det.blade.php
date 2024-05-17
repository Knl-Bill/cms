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
</head>
<body>
    <h1>Leave Request</h1>
    <form method="post" action="/leavereqs" id="leavereq" enctype="multipart/form-data">
        @csrf
        <input type="text" name="rollno" placeholder="Roll Number">
        <br><br>
        <input type="text" name="name" placeholder="Full Name (as in ID card)">
        <br><br>
        <input type="text" name="phoneno" placeholder="Phone Number">
        <br><br>
        <input type="text" name="placeofvisit" placeholder="Place Of Visit">
        <br><br>
        <input type="text" name="purpose" placeholder="Purpose of Visit">
        <br><br>
        <input type="text" name="outdate" placeholder="Out Date" onfocus="(this.type='date')" onblur="(this.type='text')">
        <br><br>
        <input type="text" name="outime" placeholder="Out Time" onfocus="(this.type='time')" onblur="(this.type='text')">
        <br><br>
        <input type="text" name="indate" placeholder="In Date" onfocus="(this.type='date')" onblur="(this.type='text')">
        <br><br>
        <input type="text" name="intime" placeholder="In Time" onfocus="(this.type='time')" onblur="(this.type='text')">
        <br><br>
        <input type="text" name="noofdays" placeholder="Number of Days">
        <br><br>
        <input type="text" placeholder="E-Mail Screenshot" accept="image/png,image/jpeg"  oninput="this.className = ''" name="image" onfocus="(this.type='file')" >
        <br><br>
        <input type="Submit" id="submit" value="Submit" style="margin-left:55px">
        <br><br>

</body>
</html>

 