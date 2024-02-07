document.addEventListener("DOMContentLoaded", function () {
    const viewDonorForm = document.getElementById("viewDonorForm");
    const donorDetailsDiv = document.getElementById("donorDetails");

    // Event listener to submit the form when it's submitted
    viewDonorForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the donor ID entered by the user
        const donorIdInput = document.getElementById("donor_id");
        const donorId = donorIdInput.value.trim();

        // Send AJAX request to view_donor.php
        fetch(`view_donor.php?donor_id=${donorId}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    // Display an error message
                    donorDetailsDiv.innerHTML = `<p>${data.error}</p>`;
                } else {
                    // Display the donor details
                    const detailsHTML = `
                        <h2>Donor Details</h2>
                        <p><strong>Donor ID:</strong> ${data.donor_id}</p>
                        <p><strong>First Name:</strong> ${data.first_name}</p>
                        <p><strong>Last Name:</strong> ${data.last_name}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Phone Number:</strong> ${data.phone_number}</p>
                        <p><strong>Date of Birth:</strong> ${data.date_of_birth}</p>
                        <p><strong>Blood Type:</strong> ${data.blood_type}</p>
                        <p><strong>Donation Date:</strong> ${data.donation_date}</p>
                        <p><strong>Address:</strong> ${data.address}</p>
                        <p><strong>City:</strong> ${data.city}</p>
                        <p><strong>State:</strong> ${data.state}</p>
                        <p><strong>Zip Code:</strong> ${data.zip_code}</p>
                    `;
                    donorDetailsDiv.innerHTML = detailsHTML;
                }
            })
            .catch((error) => {
                console.error("Error fetching donor details: " + error);
            });
    });
});
