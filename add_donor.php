<?php
$servername = "localhost"; // Change to your database server address if needed
$username = "root";        // Your database username
$password = "root";        // Your database password
$dbname = "vsd";           // Your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract data from the form
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$date_of_birth = $_POST["date_of_birth"];
$blood_type = $_POST["blood_type"];
$donation_date = $_POST["donation_date"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip_code = $_POST["zip_code"];

// Check if the donor's age is at least 18 years
if (date_diff(date_create($date_of_birth), date_create('today'))->y < 18) {
    $message = "Error: Donor must be at least 18 years old.";
} else {
    // Insert data into the 'donors' table
    $sql = "INSERT INTO donors (
        first_name,
        last_name,
        email,
        phone_number,
        date_of_birth,
        blood_type,
        donation_date,
        address,
        city,
        state,
        zip_code
    ) VALUES (
        '$first_name',
        '$last_name',
        '$email',
        '$phone_number',
        '$date_of_birth',
        '$blood_type',
        '$donation_date',
        '$address',
        '$city',
        '$state',
        '$zip_code'
    )";

    if ($conn->query($sql) === TRUE) {
        $message = "Donor added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

echo $message;
?>
