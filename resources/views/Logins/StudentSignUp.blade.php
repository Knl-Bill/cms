<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/login_signup.css">
    <script>
        var courseObject = {
        "B.Tech.": {
            "2021-2025": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2022-2026": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2023-2027": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2024-2028": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"] 
        },
        "M.Tech.": {
            "2021-2023": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2022-2024": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2023-2025": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"],
            "2024-2026": ["Computer Science and Engineering", "Electronics and Communication Engineering", "Electrical Engineering", "Civil Engineering", "Mechanical Engineering"] 
        },
        "B.Sc.": {
            "2021-2023": ["Physics", "Chemistry", "Mathematics"],
            "2022-2025": ["Physics", "Chemistry", "Mathematics"],
            "2023-2026": ["Physics", "Chemistry", "Mathematics"],
            "2024-2027": ["Physics", "Chemistry", "Mathematics"]
        },
        "M.Sc.": {
            "2021-2023": ["Physics", "Chemistry", "Mathematics"],
            "2022-2025": ["Physics", "Chemistry", "Mathematics"],
            "2023-2026": ["Physics", "Chemistry", "Mathematics"],
            "2024-2027": ["Physics", "Chemistry", "Mathematics"]
        },
        "PhD": {
            "2021-2023": ["Physics", "Chemistry", "Mathematics"],
            "2022-2025": ["Physics", "Chemistry", "Mathematics"],
            "2023-2026": ["Physics", "Chemistry", "Mathematics"],
            "2024-2027": ["Physics", "Chemistry", "Mathematics"]
        },
        }
        window.onload = function() {
        var courseSel = document.getElementById("course");
        var batchSel = document.getElementById("batch");
        var deptSel = document.getElementById("dept");
        for (var x in courseObject) {
            courseSel.options[courseSel.options.length] = new Option(x, x);
        }
        courseSel.onchange = function() {
            deptSel.length = 1;
            batchSel.length = 1;
            for (var y in courseObject[this.value]) {
            batchSel.options[batchSel.options.length] = new Option(y, y);
            }
        }
        batchSel.onchange = function() {
            deptSel.length = 1;
            var z = courseObject[courseSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
            deptSel.options[deptSel.options.length] = new Option(z[i], z[i]);
            }
        }
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid custom-navbar">
          <img class="logo" src="assets/images/logo.webp" alt="logo">
        </div>
    </nav>
    <div class="login-container">
        <div class="image-container">
            <img src="assets/images/signup.webp" alt="Sign Up Image" class="image" width="800px">
        </div>
        <div class="form-container">
            <h1 class="heading font">SIGN UP</h1>
            <form method="post" action="/signup" id="signup">
                @csrf
                <div class="form-group">
                    <label for="rollno" class="labels font">Roll Number</label>
                    <input class="inputs" type="text" name="rollno" id="rollno" placeholder="Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name" class="labels font">Full Name (as in ID card)</label>
                    <input class="inputs" type="text" name="name" id="name" placeholder="Full Name" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="labels font">Phone Number</label>
                    <input class="inputs" type="text" name="phoneno" id="phoneno" placeholder="Phone Number" required>
                    @if($errors->has('phoneno'))
                        <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                    @endif
                </div>
                <div class="form-group" >
                    <label for="email" class="labels font">E-Mail</label>
                    <input class="inputs" type="text" name="email" id="email" placeholder="E-Mail" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="course" class="labels font">Course</label>
                    <select class="inputs" id="course" name="course" required>
                        <option value="" selected="selected">Select Course</option>
                    </select>
                    @if($errors->has('course'))
                        <span class="text-danger">{{ $errors->first('course') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="batch" class="labels font">Batch</label>
                    <select class="inputs" id="batch" name="batch" required>
                        <option value="" selected="selected">Select Batch</option>
                    </select>
                    @if($errors->has('batch'))
                        <span class="text-danger">{{ $errors->first('batch') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dept" class="labels font">Department</label>
                    <select class="inputs" id="dept" name="dept" required>
                        <option value="" selected="selected">Select Department</option>
                    </select> 
                    @if($errors->has('dept'))
                        <span class="text-danger">{{ $errors->first('dept') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="gender" class="labels font">Gender</label>
                    <select class="inputs" id="gender" name="gender" required>
                        <option value="" disabled selected hidden>Choose Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="hostelname" class="labels font">Hostel Name</label>
                    <select class="inputs" id="hostelname" name="hostelname" required>
                        <option value="" selected disabled hidden>Choose Hostel Name</option>
                        <option value="Bharani Hostel">Bharani Hostel</option>
                        <option value="Bhavani Hostel">Bhavani Hostel</option>
                        <option value="Moyar Hostel">Moyar Hostel</option>
                    </select>
                    @if($errors->has('hostelname'))
                        <span class="text-danger">{{ $errors->first('hostelname') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="roomno" class="labels font">Hostel Room Number</label>
                    <input class="inputs" type="text" id="roomno" name="roomno" placeholder="Enter Hostel Room Number" required>
                    @if($errors->has('roomno'))
                        <span class="text-danger">{{ $errors->first('roomno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="faculty_advisor" class="labels font">Faculty Advisor</label>
                    <select class="inputs" id="faculty_advisor" name="faculty_advisor" required>
                        <option value="" selected disabled hidden>Select Your Faculty Advisor</option>
                        <option value="sanjay.bankapur@nitpy.ac.in">Dr. Sanjay Bankapur</option>
                        <option value="lakshmi@nitpy.ac.in">Dr. Lakshmi Sutha . G</option>
                    </select>
                    @if($errors->has('faculty_advisor'))
                        <span class="text-danger">{{ $errors->first('faculty_advisor') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="warden" class="labels font">Warden</label>
                    <select class="inputs" id="warden" name="warden" required>
                        <option value="" selected disabled hidden>Select Your Warden</option>
                        <option value="chandrashekar.r@nitpy.ac.in">Dr. Chandrashekar . R</option>
                        <option value="sunanda.a@nitpy.ac.in">Dr. Sunanda Ambulker</option>
                        <option value="hemachander.a@nitpy.ac.in">Dr. Hemachander . A</option>
                    </select>
                    @if($errors->has('warden'))
                        <span class="text-danger">{{ $errors->first('warden') }}</span>
                    @endif
                </div>
                <div class="form-group password-container">
                    <label for="password" class="labels font">Password</label>
                    <input class="inputs" type="password" id="password" name="password" placeholder="Enter Password" required>
                    <span class="password-toggle-icon"><i class="fas fa-eye"style="padding-top: 30px"></i></span>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group password-container">
                    <label for="password" class="labels font">Confirm Password</label>
                    <input class="inputs" type="password" id="password" name="confirmpass" placeholder="Enter Password Again" required>
                    <!-- <span class="password-toggle-icon"><i class="fas fa-eye"style="padding-top: 30px"></i></span> -->
                    @if($errors->has('confirmpass'))
                        <span class="text-danger">{{ $errors->first('confirmpass') }}</span>
                    @endif
                </div>
                <div class="form-group button">
                    <input class="submit-btn" type="submit" id="submit" value="Sign Up">
                </div>
                <div class="text-below-image">Have an account already? <a class="font" href="{{ route('StudentLogin') }}" style="text-decoration: none">Login</a></div>
            </form>
        </div>
    </div>
    <script>
        const passwordField = document.getElementById("password");
        const togglePassword = document.querySelector(".password-toggle-icon i");

        togglePassword.addEventListener("click", function () {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
        });
    </script>
</body>
</html>