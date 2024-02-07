<?php
// Establish a database connection
$servername = "localhost"; // Change to your database server address if needed
$username = "root";
$password = "root";
$dbname = "vsd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve all donors
$query = "SELECT donor_id, first_name, last_name, email, blood_type FROM donors";
$result = $conn->query($query);

// Process the query results and output as JSON
$donorList = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donorList[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output the donor list as JSON
header("Content-Type: application/json");
echo json_encode($donorList);
?>
