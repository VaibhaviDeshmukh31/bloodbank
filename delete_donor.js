document.addEventListener("DOMContentLoaded", function () {
    const deleteDonorForm = document.getElementById("deleteDonorForm");
    const messageDiv = document.getElementById("message");

    // Event listener to submit the form when it's submitted
    deleteDonorForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the donor ID entered by the user
        const donorIdInput = document.getElementById("donor_id");
        const donorId = donorIdInput.value.trim();

        // Send AJAX request to delete_donor.php
        fetch("delete_donor.php", {
            method: "POST",
            body: new URLSearchParams({ 'donor_id': donorId }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    // Display a success message
                    messageDiv.innerText = data.message;
                    messageDiv.style.color = "green";
                    // Clear the form field
                    donorIdInput.value = "";

                    // Show an alert after a successful deletion
                    window.alert("Donor deleted successfully");
                } else if (data.error) {
                    // Display an error message
                    messageDiv.innerText = data.error;
                    messageDiv.style.color = "red";
                }
            })
            .catch((error) => {
                console.error("Error deleting donor: " + error);
            });
    });
});
