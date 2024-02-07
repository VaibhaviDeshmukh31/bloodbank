<?php
$servername = "localhost"; // Change to your database server address if needed
$username = "root";        // Your database username
$password = "root";        // Your database password
$dbname = "vsd";           // Your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "succsessfuly connected";
}
?>
