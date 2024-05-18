<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="user">

    </div>
    <div class="Leave">
        <button id="Leave">Leave Requests</button>
    </div>
    <div class="Outing">
        <button id="Outing">Outing Request</button>
    </div>
    <div class="Academics">
        <button id="Academics">View Academic Details</button>
    </div>
    <div class="profile">
        <button id="profile">Profile</button>
    </div>
    <br><br>
    <div class="logout">
        <button id="logout">Logout</button>
    </div>
    <script>

        // Fetch the username from the Login Session
        fetch('/StudentSession').then(response => response.text()).then(data => {
            document.querySelector('.user').innerHTML = 'Welcome, ' + data;
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
    </script>
</body>
</html>