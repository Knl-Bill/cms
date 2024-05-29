var submitButtons = document.querySelectorAll(".submit-btn");
var confirmationPopup = document.getElementById("confirmationPopup");
var currentForm = null;

// Add event listeners to each submit button
submitButtons.forEach(function(button) {
    button.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission
        currentForm = button.closest("form"); // Keep track of the current form
        confirmationPopup.style.display = "block";
    });
});

document.getElementById("confirmYes").addEventListener("click", function() {
    if (currentForm) {
        console.log(currentForm);
        currentForm.dispatchEvent(new Event('submit'));
    }
});

document.getElementById("confirmNo").addEventListener("click", function() {
    confirmationPopup.style.display = "none";
    currentForm = null;
});
fetch('DisabledDetails').then(response => response.json()).then(data => {
    document.querySelectorAll('.disabled').forEach(element => {
        element.value = data.rollno;
        element.placeholder = data.placeholder;
    });
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