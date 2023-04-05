<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'snape_fleet');

// Fetch the details of the selected vehicle
$vehicleId = $_POST['id'];

// Prepare the query
$stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
$stmt->bind_param("i", $vehicleId);

// Execute the query and check for errors
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

// Get the result set and fetch the first row
$result = $stmt->get_result();
if (!$result) {
    die("Error getting result set: " . $conn->error);
}
$row = $result->fetch_assoc();

// Close the statement and database connection
$stmt->close();
$conn->close();

// Output the vehicle details as JSON
echo json_encode($row);
?> 