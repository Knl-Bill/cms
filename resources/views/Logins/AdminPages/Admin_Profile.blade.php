<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">     
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="details">
            <h1 class="heading-update">Your Details</h1>
            @foreach($students as $stud)
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
                        <td>E-Mail Address</td>
                        <td>{{$stud->email}}</td>
                    </tr>
                    <tr>
                        <td>Department </td>
                        <td>{{$stud->department}}</td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        </div>
        <div class="form-container">
            @if(Session::get('success'))
                <span class="text-safe">{{ Session::get('success') }}</span>
            @endif
            <div>
                <h1 class="heading-update">Update Your Profile</h1>
            </div>
            <h3 class="font1">Password</h3>
           
            <form method="post" action="adm_change-password" id="signup">
                @csrf
                <div class="form-group">
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">Current Password</label>
                    <input type="text" name="curr_pass" id="currpass" placeholder="Enter Current Password" required>
                    @if($errors->has('curr_pass'))
                        <span class="text-danger">{{ $errors->first('curr_pass') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New Password</label>
                    <input type="password" name="new_pass" id="newpass" placeholder="Enter New Password" required>
                    @if($errors->has('new_pass'))
                        <span class="text-danger">{{ $errors->first('new_pass') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="font">Confirm Password</label>
                    <input type="password" id="password" name="confirmpass" placeholder="Enter Password Again" required>
                    @if($errors->has('confirmpass'))
                        <span class="text-danger">{{ $errors->first('confirmpass') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>

            <!-- Update Phone Number -->
            <h3 class="font1">Phone Number</h3>
            <form method="post" action="adm_change-phoneno" id="signup">
                @csrf
                <div class="form-group">
                    <!-- <label for="phoneno" class="font">Roll Number</label>
                    <input class="disabled" disabled type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    <input class="disabled" hidden type="text" name="rollno" id="rollno" placeholder="rollno" required> -->
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New Phone Number</label>
                    <input type="text" name="new_phoneno" id="phoneno" placeholder="Enter New Phone Number" required>
                    @if($errors->has('new_phoneno'))
                        <span class="text-danger">{{ $errors->first('new_phoneno') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>

            <!-- Update Email -->
            <h3 class="font1">E-Mail Address</h3>
            <form method="post" action="adm_change-email" id="signup">
                @csrf
                <div class="form-group">
                    <!-- <label for="phoneno" class="font">Roll Number</label>
                    <input class="disabled" disabled type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    <input class="disabled" hidden type="text" name="rollno" id="rollno" placeholder="rollno" required> -->
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New E-Mail Address</label>
                    <input type="text" name="new_email" id="email" placeholder="Enter New E-Mail Address" required>
                    @if($errors->has('new_email'))
                        <span class="text-danger">{{ $errors->first('new_email') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>



        </div>
    </div>

    <!-- End of Divs, start of the JS Script Section-->
    <script>
        fetch('DisabledDetails').then(response => response.json()).then(data => {
            document.querySelectorAll('.disabled').forEach(element => {
                element.value = data.rollno;
                element.placeholder = data.placeholder;
            });
        });
    </script>
</body>
</html>
