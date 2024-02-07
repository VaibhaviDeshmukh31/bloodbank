<?php
// Include the database connection file
$servername = "localhost"; // Change to your database server address if needed
$username = "root";        // Your database username
$password = "root";        // Your database password
$dbname = "vsd";           // Your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['donor_id'])) {
    // Retrieve the donor ID from the GET request
    $donor_id = $_GET['donor_id'];

    // Perform a query to fetch the donor details
    $query = "SELECT * FROM donors WHERE donor_id =$donor_id";
    $stmt = $conn->prepare($query);
    

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $donor = $result->fetch_assoc();

        // Check if a donor with the given ID exists
        if ($donor) {
            // Display the donor details
            echo json_encode($donor);
        } else {
            echo json_encode(array("error" => "Donor not found"));
        }
    } else {
        echo json_encode(array("error" => "Error fetching donor details: " . $stmt->error));
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
