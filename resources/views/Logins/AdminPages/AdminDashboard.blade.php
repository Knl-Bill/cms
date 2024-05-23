<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <div class="user">

    </div>
    @if(Session::has('message'))
        <span class="text-danger">{{ Session::get('message')  }}</span>
    @endif
    <div class="Leave">
            <button id="LeaveId">Leave</button>
    </div><br><br>
    <div class="status">
    <a href="{{ route('leavereqshist_admin') }}">See Leave History</a>
    </div>
    <button id="logout">Logout</button>
    <script>
        fetch('/AdminSession').then(response => response.text()).then(data => {
                // Update the user name in the HTML
                document.querySelector('.user').innerText = 'Welcome, ' + data;
        });

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

        document.getElementById('LeaveId').addEventListener('click', function() {
            window.location.href = '{{route('LeaveRequests')}}';
        });
    </script>
</body>
</html>