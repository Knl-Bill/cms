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
        currentForm.reportValidity(); // Validate the form
        if (currentForm.checkValidity()) {
            // Use requestSubmit method to submit the form
            currentForm.requestSubmit();
        }
    }
    confirmationPopup.style.display = "none";
    currentForm = null;
});

document.getElementById("confirmNo").addEventListener("click", function() {
    confirmationPopup.style.display = "none";
    currentForm = null;
});

fetch('DisabledDetails')
   .then(response => response.json())
   .then(data => {
        document.querySelectorAll('.disabled').forEach(element => {
            element.value = data.rollno;
            element.placeholder = data.placeholder;
            element.disabled = true;
        });
    });

