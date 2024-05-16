<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    
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
    <div class="container">
        <div class="image-container">
            <img src="assets/images/signup.jpeg" alt="Sign Up Image" class="image">
        </div>
        <div class="form-container">
            <h1 class="font">SIGN UP</h1>
            <form method="post" action="/signup" id="signup">
                @csrf
                <div class="form-group">
                    <label for="rollno" class="font">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Roll Number" required>
                    @if($errors->has('rollno'))
                        <span class="text-danger">{{ $errors->first('rollno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name" class="font">Full Name (as in ID card)</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phoneno" class="font">Phone Number</label>
                    <input type="text" name="phoneno" id="phoneno" placeholder="Phone Number" required>
                    @if($errors->has('phoneno'))
                        <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                    @endif
                </div>
                <div class="form-group" >
                    <label for="email" class="font">E-Mail</label>
                    <input type="text" name="email" id="email" placeholder="E-Mail" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="course" class="font">Course</label>
                    <select id="course" name="course" required>
                        <option value="" selected="selected">Select Course</option>
                    </select>
                    @if($errors->has('course'))
                        <span class="text-danger">{{ $errors->first('course') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="batch" class="font">Batch</label>
                    <select id="batch" name="batch" required>
                        <option value="" selected="selected">Select Batch</option>
                    </select>
                    @if($errors->has('batch'))
                        <span class="text-danger">{{ $errors->first('batch') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dept" class="font">Department</label>
                    <select id="dept" name="dept" required>
                        <option value="" selected="selected">Select Department</option>
                    </select> 
                    @if($errors->has('dept'))
                        <span class="text-danger">{{ $errors->first('dept') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="gender" class="font">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected hidden>Choose Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="hostelname" class="font">Hostel Name</label>
                    <select id="hostelname" name="hostelname" required>
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
                    <label for="roomno" class="font">Hostel Room Number</label>
                    <input type="text" id="roomno" name="roomno" placeholder="Enter Hostel Room Number" required>
                    @if($errors->has('roomno'))
                        <span class="text-danger">{{ $errors->first('roomno') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="font">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
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
                    <input type="submit" id="submit" value="Sign Up">
                </div>
                <!-- @if ($errors->any())
                    <div class="alertalert-danger ">
                        <h3 class="font">Error..Please Try Again</h3>
                        <div class="error"  >
                            @foreach ($errors->all() as $error)
                                <div class="mssg"  >
                                    <img class="error_img" src="assets/images/Error.webp" alt="">
                                    <p class="err_p"> {{ $error }} </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif -->
                <div class="text-below-image">Have an account already? <a class="font" href="{{ route('login') }}">Login</a></div>
            </form>
        </div>
    </div>
</body>
</html>