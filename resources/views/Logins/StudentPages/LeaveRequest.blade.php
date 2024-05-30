<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request For Leave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/login_signup.css">
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
                <a class="nav-link home-btn" href='{{route('StudentDashboard')}}'><i class="bi bi-house-door-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link profile-btn" href='{{route('StudentProfile')}}'><i class="bi bi-person-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logout-btn" id="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="login-container">
        <div class="image-container">
            <img src="assets/images/leave.webp" alt="Leave Image" class="image" width="800px">
        </div>
        <div class="form-container">
            <div class="form-group button">
                <button class="form-group button submit-btn" id="status">See your Leave Status</button>
            </div>
            <div class="form-group button">
                <button class="form-group button submit-btn" id="leavehistory">Leave History</button>
            </div>
            <h1 class="heading font">LEAVE FORM</h1>
            @if (Session::get('success'))
                <span class="text-safe" role="alert">
                    {{ Session::get('success') }}
                </span>
            @endif
            <form method="post" action="/InsertLeaveRequest" id="leavereq" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="labels font" for="rollno">Roll No: - </label>
                    <input class="inputs disabled" disabled id="rollno" type="text" name="rollno" placeholder="Roll Number">
                </div>
                <div class="form-group">
                    <label class="labels font" for="name">Name: - </label>
                    <input class="inputs disabled" disabled id="name" type="text" name="name" placeholder="Full Name (as in ID card)">
                </div>
                <div class="form-group">
                    <label class="labels font" for="phoneno">Phone No: - </label>
                    <input class="inputs disabled" disabled id="phoneno" type="text" name="phoneno" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label class="labels font" for="placeofvisit">Place of Visit: - </label>
                    <input class="inputs" type="text" name="placeofvisit" placeholder="Place Of Visit" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="purpose">Purpose of Visit: - </label>
                    <input class="inputs" type="text" name="purpose" placeholder="Purpose of Visit" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="outdate">Out Date: - </label>
                    <input class="inputs" type="text" name="outdate" placeholder="Out Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="outime">Out Time: - </label>
                    <input class="inputs" type="text" name="outime" placeholder="Out Time" onfocus="(this.type='time')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="indate">In Date: - </label>
                    <input class="inputs" type="text" name="indate" placeholder="In Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="intime">In Time: - </label>
                    <input class="inputs" type="text" name="intime" placeholder="In Time" onfocus="(this.type='time')" onblur="(this.type='text')" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="noofdays">No of Days: - </label>
                    <input class="inputs" type="text" name="noofdays" placeholder="Number of Days" required>
                </div>
                <div class="form-group">
                    <label class="labels font" for="image">Screenshot of E-Mail from Parents: - </label>
                    @if($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                    <input class="inputs" type="text" placeholder="E-Mail Screenshot" accept="image/png,image/jpeg"  oninput="this.className = ''" name="image" onfocus="(this.type='file')">
                </div>
                <div class="form-group button">
                    <input class="submit-btn" type="Submit" id="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script>
        fetch('DisabledDetails').then(response => response.json()).then(data => {
            document.getElementById('rollno').value = data.rollno;
            document.getElementById('rollno').placeholder = data.rollno;

            document.getElementById('name').value = data.name;
            document.getElementById('name').placeholder = data.name;

            document.getElementById('phoneno').value = data.phoneno;
            document.getElementById('phoneno').placeholder = data.phoneno;
        });

        document.getElementById('status').addEventListener('click', function() {
            window.location.href = '{{route('pendingleavereqshist')}}'
        });

        document.getElementById('leavehistory').addEventListener('click', function() {
            window.location.href = '{{route('GetLeaves')}}'
        });
    </script>
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

 