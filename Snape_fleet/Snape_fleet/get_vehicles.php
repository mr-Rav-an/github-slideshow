<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "snape_fleet";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve vehicle numbers from database
$sql = "SELECT vehicle_number FROM incidents";
$result = mysqli_query($conn, $sql);

// Format vehicle numbers as JSON code
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['vehicle_number'];
}
$json_data = json_encode($data);

// Set content type header to JSON
header('Content-Type: application/json');

// Output formatted vehicle numbers as JSON
echo $json_data;

// Close database connection
mysqli_close($conn);
?>