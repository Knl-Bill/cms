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
            <h1>SIGN UP</h1>
            <form method="post" action="/signup" id="signup">
                @csrf
                <div class="form-group">
                    <label for="rollno">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" placeholder="Roll Number" required>
                </div>
                <div class="form-group">
                    <label for="name">Full Name (as in ID card)</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label for="phoneno">Phone Number</label>
                    <input type="text" name="phoneno" id="phoneno" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" name="email" id="email" placeholder="E-Mail" required>
                </div>
                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" name="course">
                        <option value="" selected="selected">Select Course</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="batch">Batch</label>
                    <select id="batch" name="batch">
                        <option value="" selected="selected">Select Batch</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dept">Department</label>
                    <select id="dept" name="dept">
                        <option value="" selected="selected">Select Department</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled selected hidden>Choose Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hostelname">Hostel Name</label>
                    <select id="hostelname" name="hostelname" required>
                        <option value="" selected disabled hidden>Choose Hostel Name</option>
                        <option value="Bharani Hostel">Bharani Hostel</option>
                        <option value="Bhavani Hostel">Bhavani Hostel</option>
                        <option value="Moyar Hostel">Moyar Hostel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="roomno">Hostel Room Number</label>
                    <input type="text" id="roomno" name="roomno" placeholder="Enter Hostel Room Number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <div class="form-group button">
                    <input type="submit" id="submit" value="Sign Up">
                </div>
                <div class="text-below-image">Have an account already? <a href="{{ route('login') }}">Login</a></div>
            </form>
        </div>
    </div>
</body>
</html>