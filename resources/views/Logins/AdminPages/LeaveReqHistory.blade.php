<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/stud_det.css">
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
                <a class="nav-link home-btn" id="home" href='{{route('AdminDashboard')}}'><i class="bi bi-house-door-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link profile-btn" id="profile" href='{{route('AdminProfile')}}'><i class="bi bi-person-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logout-btn" id="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="table-container">
      <h1 class="heading font">LEAVE REQUESTS</h1>
      <div class="accordion" id="accordionExample">
          @foreach($students as $stud)
        <div class="accordion-item" >
          <h2 class="accordion-header">
            @if($stud->status=="Approved")
              <button style="background-color:limegreen;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
              Roll Number --  {{$stud->rollno}}
              </button>
            @elseif($stud->status=="Declined")
              <button style="background-color:red;"class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
              Roll Number --  {{$stud->rollno}}
              </button>
            @endif
          </h2>
          <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <table class="table table-striped-columns table-bordered">
              <tbody>
              <tr>
                  <td>Roll Number</td>
                  <td>{{$stud->rollno}}</td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td>{{$stud->name}}</td>
                </tr>
                <tr>
                  <td>Phone Number</td>
                  <td>{{$stud->phoneno}}</td>
                </tr>
                <tr>
                  <td>Place of Visit</td>
                  <td>{{$stud->placeofvisit}}</td>
                </tr>
                <tr>
                  <td>Purpose of Visit</td>
                  <td>{{$stud->purpose}}</td>
                </tr>
                <tr>
                  <td>Out Date</td>
                  <td>{{date('d/m/Y',strtotime($stud->outdate))}}</td>
                </tr>
                <tr>
                  <td>Out Time </td>
                  <td>{{date('h:i a',strtotime($stud->outime))}}</td>
                </tr>
                <tr>
                  <td>In Date  </td>
                  <td>{{date('d/m/Y',strtotime($stud->indate))}}</td>
                </tr>
                <tr>
                  <td>In Time </td>
                  <td>{{date('h:i a',strtotime($stud->intime))}}</td>
                </tr>
                <tr>
                  <td>No. Of Days </td>
                  <td>{{$stud->noofdays}}</td>
                </tr>
                <tr>
                  <td>Status </td>
                  <td>{{$stud->status}}</td>
                </tr>  
              </tbody>
            </table>
            @if ($stud->image!=NULL)
              <div>
                  <img src="storage/{{$stud->image}}" alt="email screenshot" style="width:400px;height:100px;">
              </div> 
            @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <script>
      document.getElementById('logout').addEventListener('click', function() {
        // Make an AJAX request to trigger the Logout function
            fetch('/AdminLogout').then(response => {
                    if(response.ok) 
                    {
                        // If logout successful, redirect to home page
                        window.location.reload();
                        window.location.href = '/';
                    } 
                    else 
                    {
                        // If logout failed, handle error
                        console.error('Logout failed');
                    }
            })
            .catch(error => {
                console.error('Error during logout:', error);
            });
        });
    </script>
</body>
</html>