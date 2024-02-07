<?php
// Include the database connection file
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the donor ID from the POST request
    $donor_id = $_POST['donor_id'];

    // Prepare and execute the SELECT statement to check if the donor exists
    $selectStmt = $conn->prepare("SELECT * FROM donors WHERE donor_id = ?");
    $selectStmt->bind_param("i", $donor_id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(array("error" => "Donor with ID $donor_id not found."));
    } else {
        // Update the donor's details
        $updateStmt = $conn->prepare("UPDATE donors SET 
            first_name = ?,
            last_name = ?,
            email = ?,
            phone_number = ?,
            date_of_birth = ?,
            blood_type = ?,
            donation_date = ?,
            address = ?,
            city = ?,
            state = ?,
            zip_code = ?
            WHERE donor_id = ?");

        $updateStmt->bind_param(
            "sssssssssssi",
            $first_name,
            $last_name,
            $email,
            $phone_number,
            $date_of_birth,
            $blood_type,
            $donation_date,
            $address,
            $city,
            $state,
            $zip_code,
            $donor_id
        );

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $date_of_birth = $_POST['date_of_birth'];
        $blood_type = $_POST['blood_type'];
        $donation_date = $_POST['donation_date'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip_code = $_POST['zip_code'];

        if ($updateStmt->execute()) {
            echo json_encode(array("message" => "Donor updated successfully."));
        } else {
            echo json_encode(array("error" => "Error updating donor: " . $updateStmt->error));
        }

        // Close the prepared statement
        $updateStmt->close();
    }

    // Close the prepared statement for SELECT
    $selectStmt->close();
} else {
    // Invalid request method
    echo json_encode(array("error" => "Invalid request method"));
}

// Close the database connection
$conn->close();
?>
