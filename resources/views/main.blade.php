<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <style>
        body{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }
    </style>
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
    <h1>SignUp</h1>
    <form method="post" action="/signup" id="signup">
        @csrf
        <input type="text" name="rollno" placeholder="Roll Number">
        <br><br>
        <input type="text" name="name" placeholder="Full Name (as in ID card)">
        <br><br>
        <input type="text" name="phoneno" placeholder="Phone Number">
        <br><br>
        <input type="text" name="email" placeholder="E-Mail">
        <br><br>
        <select id="course" name="course">
            <option value="" selected="selected">Select Course</option>
        </select>
        <br><br>
        <select id="batch" name="batch">
            <option value="" selected="selected">Select Batch</option>
        </select>    
        <br><br>
        <select id="dept" name="dept">
            <option value="" selected="selected">Select Department</option>
        </select>    
        <br><br>
        
        <select id="gender" name="gender">
            <option value="" disabled selected hidden>Choose Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
        <br><br>
        <select id="hostelname" name="hostelname">
        <option value="" disabled selected hidden>Choose Hostel Name</option>
            <option>Bharani Hostel</option>
            <option>Bhavani Hostel</option>
            <option>Moyar Hostel</option>
        </select>
        <br><br>
        <input type="text" id="roomno" name="roomno" placeholder="Enter Hostel Room Number">
        <br><br>
        <input type="password" id="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="Submit" id="submit" value="Submit" style="margin-left:55px">

        <br><br>
        <a href="{{ route('login') }}">Login</a>

</body>
</html>

 