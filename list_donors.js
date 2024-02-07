document.addEventListener("DOMContentLoaded", function () {
    const loadDonorsButton = document.getElementById("loadDonorsButton");
    const donorListDiv = document.getElementById("donorList");

    // Event listener to load donors when the button is clicked
    loadDonorsButton.addEventListener("click", function () {
        // Fetch data from list_donors.php
        fetch("list_donors.php")
            .then((response) => response.json())
            .then((data) => {
                // Create an HTML table to display the donor list
                let donorListHTML = "<table border='1'>";
                donorListHTML += "<tr><th>Donor ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Blood Type</th></tr>";

                // Loop through the donor data and add rows to the table
                data.forEach(function (donor) {
                    donorListHTML += "<tr>";
                    donorListHTML += "<td>" + donor.donor_id + "</td>";
                    donorListHTML += "<td>" + donor.first_name + "</td>";
                    donorListHTML += "<td>" + donor.last_name + "</td>";
                    donorListHTML += "<td>" + donor.email + "</td>";
                    donorListHTML += "<td>" + donor.blood_type + "</td>";
                    donorListHTML += "</tr>";
                });

                donorListHTML += "</table>";

                // Display the donor list in the donorListDiv
                donorListDiv.innerHTML = donorListHTML;
            })
            .catch((error) => {
                console.error("Error loading donors: " + error);
            });
    });
});
