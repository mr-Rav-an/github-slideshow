<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'snape_fleet');

// Fetch the list of vehicles
$result = mysqli_query($conn, 'SELECT id, number FROM vehicles');
$vehicles = array();
while ($row = mysqli_fetch_assoc($result)) {
    $vehicles[] = $row;
}

// Return the list of vehicles as JSON
header('Content-Type: application/json');
echo json_encode($vehicles);
?>