<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outing History</title>
    <link rel="stylesheet" href="assets/css/OutingHistory.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                Outing History
            </h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Out Time</th>
                    <th>In Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($OutingHistory as $outing)
                <tr>
                    <td>{{$outing->rollno}}</td>
                    <td>{{$outing->outtime}}</td>
                    <td>{{$outing->intime}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>