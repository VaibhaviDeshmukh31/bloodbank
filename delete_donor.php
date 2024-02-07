<?php
// Include the database connection file
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the donor ID from the POST request
    $donor_id = $_POST['donor_id'];

    // Prepare and execute the stored procedure to delete the donor
    $stmt = $conn->prepare("CALL DeleteDonor(?)");
    $stmt->bind_param("i", $donor_id);

    if ($stmt->execute()) {
        // Success: Display a success message
        echo json_encode(array("message" => "Donor deleted successfully"));
    } else {
        // Error: Handle errors and display an error message
        echo json_encode(array("error" => "Error deleting donor: " . $stmt->error));
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Invalid request method
    echo json_encode(array("error" => "Invalid request method"));
}

// Close the database connection
$conn->close();
?>
