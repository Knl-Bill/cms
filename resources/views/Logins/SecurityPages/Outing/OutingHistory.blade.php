<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outing History</title>
    <link rel="stylesheet" href="assets/css/SecurityOutingHistory.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                {{$Name}}
            </h1>
        </div>
        <br>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Roll No</th>
                        <th>Out Time</th>
                        <th>In Time</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>E-Mail</th>
                        <th>Year</th>
                        <th>Gender</th>
                        <th>Hostel</th>
                        <th>Room No</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($OutingHistory as $outing)
                    <tr class="{{$outing->gender == 'Male'? 'MaleRow' : 'FemaleRow'}}">
                        <td>{{$outing->rollno}}</td>
                        <td>{{$outing->outtime}}</td>
                        <td>{{$outing->intime}}</td>
                        <td>{{$outing->name}}</td>
                        <td>{{$outing->phoneno}}</td>
                        <td>{{$outing->email}}</td>
                        <td>{{$outing->year}}</td>
                        <td>{{$outing->gender}}</td>
                        <td>{{$outing->hostel}}</td>
                        <td>{{$outing->roomno}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>