<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page if not logged in
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>SnapE Fleet Manager</title>

    <link rel="stylesheet" href="welcome.css"> 

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">SnapE Fleet Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="welcome.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vehicles.php">New incident</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="repair.php">Repair Partner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="insurance.php">Insurance Partner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Analysis.php">Analysis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
        </ul>

       
<!-- Vehicle Dropdown -->
<div class="dropdown ml-auto">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Select Vehicle</button>
    <div class="dropdown-menu" id="vehicle-dropdown">
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add event listener to dropdown button -->
<script>
$(document).ready(function() {
  // When dropdown button is clicked
  $(".dropdown-toggle").click(function() {
    // Retrieve vehicle numbers from PHP script
    var url = "get_vehicles.php";
    $.ajax({
      url: url,
      success: function(result) {
        // Parse vehicle numbers from PHP script response
        var vehicles = $.parseJSON(result);

        // Clear existing dropdown items
        $("#vehicle-dropdown").empty();

        // Add new dropdown items for each vehicle number
        $.each(vehicles, function(index, value) {
          var itemHtml = "<a class='dropdown-item' href='#'>" + value + "</a>";
          $("#vehicle-dropdown").append(itemHtml);
        });
      }
    });
  });
});
       
</script>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome " . $_SESSION['username'] ?></a>
            </li>
        </ul>
    </div>
</nav>


<div class="container mt-4">
<div class="container mt-4">
  <h3>Recent Incidents</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Incident Date</th>
        <th>Vehicle Number</th>
        <th>Hub Name</th>
        <th>Driver ID</th>
        <th>Driver Name</th>
        <th>Service Station</th>
        <th>Damage Type</th>
        <th>Deductions</th>
        <th>Status</th>
        <th>Date Sent</th>
        <th>Date Received</th>
        <th>Invoice Number</th>
        <th>Repair Costs</th>
        <th>Insurance DO</th>
        <th>Our Share</th>
        <th>Month</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Replace with your own database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "snape_fleet";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Query to select the data from the incidents table
        $sql = "SELECT * FROM incidents ORDER BY incident_date DESC LIMIT 10";

        // Execute the query and store the results in $result
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
          // Loop through each row of data
          while ($row = $result->fetch_assoc()) {
            // Print the data in a table row
            echo '<tr>';
            echo '<td>' . $row['incident_date'] . '</td>';
            echo '<td>' . $row['vehicle_number'] . '</td>';
            echo '<td>' . $row['hub_name'] . '</td>';
            echo '<td>' . $row['driver_id'] . '</td>';
            echo '<td>' . $row['driver_name'] . '</td>';
            echo '<td>' . $row['service_station'] . '</td>';
            echo '<td>' . $row['damage_type'] . '</td>';
            echo '<td>' . $row['deductions'] . '</td>';
            echo '<td>' . $row['remarks'] . '</td>';
            echo '<td>' . $row['date_sent'] . '</td>';
            echo '<td>' . $row['date_received'] . '</td>';
            echo '<td>' . $row['invoice_number'] . '</td>';
            echo '<td>' . $row['repair_costs'] . '</td>';
            echo '<td>' . $row['insurance_do'] . '</td>';
            echo '<td>' . $row['our_share'] . '</td>';
            echo '<td>' . $row['month'] . '</td>';
            echo '<td><a href="edit_incident.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary">Edit</a></td>';
            echo '</tr>';
            
          }
        
        } else {
          echo '<tr><td colspan="16">No incidents found.</td></tr>';
        }

        // Close the database connection
        $conn->close();
      ?>
    </tbody>
  </table>
</div>