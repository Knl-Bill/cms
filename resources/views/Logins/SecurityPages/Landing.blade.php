<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <div class="user">

    </div>
    <a id="profile"> Profile</a>
    <div>
        <div class="Outing">
            <button id="OutingId">Outing</button>
        </div>
        <div class="Leave">
            <button id="LeaveId">Leave</button>
        </div><br><br>
        <div class="logout">
            <button id="logout">Logout</button>
        </div>
    </div>
    <script>
        fetch('/SecuritySession').then(response => response.text()).then(data => {
                // Update the user name in the HTML
                document.querySelector('.user').innerText = 'Welcome, ' + data;
            });
        
        document.getElementById('logout').addEventListener('click', function() {
        // Make an AJAX request to trigger the Logout function
            fetch('/SecurityLogout').then(response => {
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
            window.location.href = '{{route('LeaveText')}}';
        });
        document.getElementById('OutingId').addEventListener('click', function() {
            window.location.href = '{{route('OutingText')}}';
        });
        document.getElementById('profile').addEventListener('click', function() {
            window.location.href = '{{route('SecurityProfile')}}';
        });
    </script>
</body>
</html>