<?php
// Include the database connection file
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['blood_group'])) {
    // Retrieve the selected blood group from the GET request
    $blood_group = $_GET['blood_group'];

    // Perform a query to fetch donors with the selected blood group
    $query = "SELECT * FROM donors WHERE blood_type = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $blood_group);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if there are donors with the selected blood group
        if ($result->num_rows > 0) {
            // Create an HTML table to display the donor details
            $tableHTML = "<table border='1'>";
            $tableHTML .= "<tr><th>Donor ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Date of Birth</th></tr>";

            // Loop through the donor data and add rows to the table
            while ($row = $result->fetch_assoc()) {
                $tableHTML .= "<tr>";
                $tableHTML .= "<td>" . $row['donor_id'] . "</td>";
                $tableHTML .= "<td>" . $row['first_name'] . "</td>";
                $tableHTML .= "<td>" . $row['last_name'] . "</td>";
                $tableHTML .= "<td>" . $row['email'] . "</td>";
                $tableHTML .= "<td>" . $row['date_of_birth'] . "</td>";
                $tableHTML .= "</tr>";
            }

            $tableHTML .= "</table>";
            echo $tableHTML;
        } else {
            echo json_encode(array("message" => "No donors with the selected blood group found."));
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
