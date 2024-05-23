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
                    <th>Out Date and Time</th>
                    <th>In Date and Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($OutingHistory as $outing)
                <tr>
                    <td>{{$outing->rollno}}</td>
                    <td>{{date('d/m/Y h:i a',strtotime($outing->outtime))}}</td>
                    <td>{{date('d/m/Y h:i a',strtotime($outing->intime))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>