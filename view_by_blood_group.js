document.addEventListener("DOMContentLoaded", function () {
    const viewBloodGroupForm = document.getElementById("viewBloodGroupForm");
    const donorTableDiv = document.getElementById("donorTable");

    // Event listener to submit the form when it's submitted
    viewBloodGroupForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the selected blood group from the form
        const bloodGroupSelect = document.getElementById("blood_group");
        const selectedBloodGroup = bloodGroupSelect.value;

        // Send AJAX request to view_by_blood_group.php
        fetch(`view_by_blood_group.php?blood_group=${selectedBloodGroup}`)
            .then((response) => response.text())
            .then((data) => {
                donorTableDiv.innerHTML = data;
            })
            .catch((error) => {
                console.error("Error fetching donor details: " + error);
            });
    });
});
