<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login_signup.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="assets/images/signup.jpeg" alt="Sign Up Image" class="image">
        </div>
        <div class="form-container">
            <h1 class="font">Update Your Password</h1>
            @if(Session::get('success'))
                <span class="text-safe">{{ Session::get('success') }}</span>
            @endif
            <form method="post" action="change-password" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">Current Password</label>
                    <input type="text" name="curr_pass" id="rollno" placeholder="Enter Current Password" required>
                    @if($errors->has('curr_pass'))
                        <span class="text-danger">{{ $errors->first('curr_pass') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New Password</label>
                    <input type="password" name="new_pass" id="rollno" placeholder="Enter New Password" required>
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


            <!-- Update Room Number -->
            <h1 class="font">Update Your Room Number</h1>
            <form method="post" action="change-roomno" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New Room Number</label>
                    <input type="text" name="new_roomno" id="rollno" placeholder="Enter New Room Number" required>
                    @if($errors->has('new_roomno'))
                        <span class="text-danger">{{ $errors->first('new_roomno') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>

            <!-- Update Hostel -->
            <h1 class="font">Update Your Hostel</h1>
            <form method="post" action="change-hostel" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="hostelname" class="font">New Hostel Name</label>
                    <select id="hostelname" name="new_hostelname" required>
                        <option value="" selected disabled hidden>Choose Hostel Name</option>
                        <option value="Bharani Hostel">Bharani Hostel</option>
                        <option value="Bhavani Hostel">Bhavani Hostel</option>
                        <option value="Moyar Hostel">Moyar Hostel</option>
                    </select>
                    @if($errors->has('new_hostelname'))
                        <span class="text-danger">{{ $errors->first('new_hostelname') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>

            <!-- Update Phone Number -->
            <h1 class="font">Update Your Phone Number</h1>
            <form method="post" action="change-phoneno" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New Phone Number</label>
                    <input type="text" name="new_phoneno" id="rollno" placeholder="Enter New Phone Number" required>
                    @if($errors->has('new_phoneno'))
                        <span class="text-danger">{{ $errors->first('new_phoneno') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>

            <!-- Update Email -->
            <h1 class="font">Update Your E-Mail Address</h1>
            <form method="post" action="change-email" id="signup">
                @csrf
                <div class="form-group">
                    <label for="phoneno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Enter Your Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">New E-Mail Address</label>
                    <input type="text" name="new_email" id="rollno" placeholder="Enter New E-Mail Address" required>
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
</body>
</html>
