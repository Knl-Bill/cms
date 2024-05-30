<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/OutingHistory.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid custom-navbar">
          <img class="logo" src="assets/images/logo.webp" alt="logo">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav custom-nav-items">
              <li class="nav-item">
                <a class="nav-link home-btn" id="home" href='{{route('StudentDashboard')}}'><i class="bi bi-house-door-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link profile-btn" id="profile" href='{{route('StudentProfile')}}'><i class="bi bi-person-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logout-btn" id="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="outing-container">
        <div class="header">
            <h1 class="heading font">
                LEAVE HISTORY
            </h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Out Date and Time</th>
                    <th>In Date and Time</th>
                    <th>Place</th>
                    <th>Out Registration</th>
                    <th>Out-Gate</th>
                    <th>In Registration</th>
                    <th>In-Gate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($LeaveHistory as $leave)
                <tr>
                    <td>{{$leave->rollno}}</td>
                    <td>{{date('d/m/Y h:i a',strtotime($leave->outtime))}}</td>
                    <td>{{$leave->intime== NULL?NULL: date('d/m/Y h:i a',strtotime($leave->intime))}}</td>
                    <td>{{$leave->placeofvisit}}</td>
                    <td>{{$leave->outregistration}}</td>
                    <td>{{$leave->outgate}}</td>
                    <td>{{$leave->inregistration}}</td>
                    <td>{{$leave->ingate}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click',function() {
        // Make an AJAX Request to trigger the Logout function
            fetch('/StudentLogout').then(response => {
                if(response.ok)
                {
                    // If logout Successful, redirect to home page
                    window.location.reload();
                    window.location.href = '/';
                }
                else{
                    // If logout failed, handle error
                    console.error('Logout Failed');
                }
            })
            .catch(error => {
                console.error('Error during logout',error);
            });
        });
    </script>
</body>
</html>