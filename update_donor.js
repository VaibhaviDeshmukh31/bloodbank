document.addEventListener("DOMContentLoaded", function () {
    const updateDonorForm = document.getElementById("updateDonorForm");
    const messageDiv = document.getElementById("message");

    // Event listener to submit the form when it's submitted
    updateDonorForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the donor ID entered by the user
        const donorIdInput = document.getElementById("donor_id");
        const donorId = donorIdInput.value.trim();

        // Send AJAX request to update_donor.php
        fetch("update_donor.php", {
            method: "POST",
            body: new FormData(updateDonorForm), // Send the entire form data
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    // Display a success message
                    messageDiv.innerText = data.message;
                    messageDiv.style.color = "green";
                    // Clear the form field
                    donorIdInput.value = "";
                    updateDonorForm.reset(); // Reset the form

                } else if (data.error) {
                    // Display an error message
                    messageDiv.innerText = data.error;
                    messageDiv.style.color = "red";
                }
            })
            .catch((error) => {
                console.error("Error updating donor: " + error);
            });
    });
});
