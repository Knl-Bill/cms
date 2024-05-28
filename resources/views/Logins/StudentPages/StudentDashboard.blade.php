<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css"> 
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid custom-navbar">
          <img class="logo" src="assets/images/logo.webp" alt="logo">
          <a class="navbar-brand custom-brand" href="#">NIT Puducherry</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav custom-nav-items">
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
    <div class="dashboard-text">
        <div class="user">

        </div>
        <h1 class="heading font">DASHBOARD</h1>
        <div class="status">
            <a class="leave-status" href="{{ route('leavereqshist') }}">Leave Requests History</a>
        </div>
    </div>
    <div class="dashboard container">
        <div class="item">
            <img src="assets/images/leave_1.webp" alt="Leave" height="250px">
            <button id="Leave">Leave Requests</button>
        </div>
        <div class="item">
            <img src="assets/images/outing.webp" alt="Outing" height="250px">
            <button id="Outing">Outing History</button>
        </div>
        <div class="item ">
            <img src="assets/images/student.webp" alt="Admin" height="250px">
            <button id="Academics">View Academic Details</button>
        </div>
    </div>
    <script>

        // Fetch the username from the Login Session
        fetch('/StudentSession').then(response => response.text()).then(data => {
            document.querySelector('.user').innerHTML = '<h4>Welcome,</h4>' + data;
        });
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

        // Event Listener for Leave Request Button
        document.getElementById('Leave').addEventListener('click', function() {
            window.location.href = '{{route('LeaveRequestPage')}}';
        });

        // Event Listener for Profile Button
        document.getElementById('profile').addEventListener('click', function() {
            window.location.href = '{{route('StudentProfile')}}';
        });

        // Event Listener for Outing History Button
        document.getElementById('Outing').addEventListener('click', function() {
            window.location.href = '{{route('GetOutings')}}';
        });
    </script>
</body>
</html>