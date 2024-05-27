<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="assets/css/stud_det.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">     
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css"/>
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
                <a class="nav-link profile-btn" id="profile"><i class="bi bi-person-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logout-btn" id="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="table-container">
      <h1 class="heading">Leave Requests</h1>
      <div class="status">
          <a href="{{ route('leavereqshist_admin') }}">See Leave History</a>
      </div>
      @if (Session::get('success'))
          <span class="text-safe" role="alert">
              {{ Session::get('success') }}
          </span>
      @endif
      <div class="accordion" id="accordionExample">
        @foreach ($students as $stud)
        <div class="accordion-item" >
          <h2 class="accordion-header">
          @if(session()->has('role'))
            @if(session('role')=="faculty")
              @if($stud->faculty_adv==1)
                <button style="background-color:limegreen;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                  {{$stud->rollno}}
                </button>
              @else
                <button  class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                  {{$stud->rollno}}
                </button>
              @endif
            @else
              @if($stud->faculty_adv==1)
                <button style="background-color:orange;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                  {{$stud->rollno}}
                </button>
              @else
                <button  class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                  {{$stud->rollno}}
                </button>
              @endif
            @endif
          @endif
          </h2>
          <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <table class="table table-striped-columns table-bordered">
                <tbody>
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
                </tbody>
              </table>
              @if ($stud->image!=NULL)
              <div>
                  <img src="storage/{{$stud->image}}" alt="email screenshot" style="width:400px;height:100px;">
              </div> 
              @endif
              
              <div class="approval">
                @if(session()->has('role'))
                  <!-- <p>{{session('role')}}</p> -->
                  @if(session('role')=="faculty")
                    <div class="buttons">
                      <h3>Faculty Advisor Approval</h3>
                      @if($stud->faculty_adv==0)
                        <form method="post" action="/LeaveRequestFaculty/{{$stud->rollno}}" enctype="multipart/form-data">
                          @csrf
                          <div class="approval">
                            <div class="approval-btns">
                              <input type="checkbox" id="faculty_checkbox" name="fac_acc" value="Accept" >
                              <label>Accept</label>
                            </div>
                            <div class="approval-btns">
                              <input type="checkbox" id="faculty_checkbox" name="fac_dec" value="Decline">
                              <label>Decline</label>
                            </div>
                            <div class="approval-btns">
                              <input class="submit-btn" type="Submit" id="submit" value="Submit">
                            </div>
                          </div>
                        </form>
                        @elseif($stud->faculty_adv==1)
                          <h5>Approved</h5>
                        @else
                          <h5>Declined</h5>
                      @endif
                    </div>
                  @else
                    <div class="buttons">
                      @if($stud->faculty_adv==1)
                        <h5>Faculty Advisor has Approved this request.</h5>
                      @endif
                      <h3>Warden Approval</h3>
                      @if($stud->warden==0)
                        <form method="post" action="/LeaveRequestWarden/{{$stud->rollno}}" enctype="multipart/form-data">
                          @csrf
                          <div class="approval-buttons">
                            <div class="approval-btns">
                              <input type="checkbox" id="warden_checkbox" name="war_acc" value="Accept">
                              <label>Accept</label>
                            </div>
                            <div class="approval-btns">
                              <input type="checkbox" id="warden_checkbox" name="war_dec" value="Decline">
                              <label>Decline</label>
                            </div>
                            <div class="approval-btns">
                              <input class="submit-btn" type="Submit" id="submit" value="Submit">
                            </div>
                          </div>
                        </form>
                        @elseif($stud->warden==1)
                          <h5>Approved</h5>
                        @else
                          <h5>Declined</h5>
                      @endif
                    </div>
                  @endif
                @endif  
              </div> 
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