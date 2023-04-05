
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>SnapE Fleet Manager</title>
    <style>
     body {
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

.container {
  margin-top: 10px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
}

h1 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 30px;
}
form {
  border: 1px solid #ccc;
  padding: 30px;
  background-color: #fff;
  margin-top: 10px;
}
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
  display: block;
}

.form-group input[type="text"],
.form-group input[type="date"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 16px;
}

.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 16px;
  resize: none;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border-radius: 3px;
  font-size: 16px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0069d9;
}
    </style>


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

        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome " ?></a>
            </li>
        </ul>
    </div>
</nav>


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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the incident ID from the URL parameter
  $incident_id = $_GET["id"];

  // Retrieve the form data
  $incident_date = $_POST["incident_date"];
  $vehicle_number = $_POST["vehicle_number"];
  $hub_name = $_POST["hub_name"];
  $driver_id = $_POST["driver_id"];
  $driver_name = $_POST["driver_name"];
  $service_station = $_POST["service_station"];
  $damage_type = $_POST["damage_type"];
  $deductions = $_POST["deductions"];
  $remarks = $_POST["remarks"];
  $date_sent = $_POST["date_sent"];
  $date_received = $_POST["date_received"];
  $invoice_number = $_POST["invoice_number"];
  $repair_costs = $_POST["repair_costs"];
  $insurance_do = $_POST["insurance_do"];
  $our_share = $_POST["our_share"];
  $month = $_POST["month"];

  // Update the incident record in the database
  $sql = "UPDATE incidents SET 
            incident_date = '$incident_date',
            vehicle_number = '$vehicle_number',
            hub_name = '$hub_name',
            driver_id = '$driver_id',
            driver_name = '$driver_name',
            service_station = '$service_station',
            damage_type = '$damage_type',
            deductions = '$deductions',
            remarks = '$remarks',
            date_sent = '$date_sent',
            date_received = '$date_received',
            invoice_number = '$invoice_number',
            repair_costs = '$repair_costs',
            insurance_do = '$insurance_do',
            our_share = '$our_share',
            month = '$month'
          WHERE id = $incident_id";
  if ($conn->query($sql) === TRUE) {
    echo "Incident updated successfully";
  } else {
    echo "Error updating incident: " . $conn->error;
  }
}

// Retrieve the incident ID from the URL parameter
$incident_id = $_GET["id"];

// Query to select the data for the specified incident ID
$sql = "SELECT * FROM incidents WHERE id = $incident_id";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
  // Retrieve the data for the specified incident ID
  $row = $result->fetch_assoc();

  // Print the form to edit the incident record
  echo '<form method="post">';
  echo '<label for="incident_date">Incident Date:</label><br>';
  echo '<input type="date" id="incident_date" name="incident_date" value="' . $row["incident_date"] . '"><br>';
  echo '<label for="vehicle_number">Vehicle Number:</label><br>';
  echo '<input type="text" id="vehicle_number" name="vehicle_number" value="' . $row["vehicle_number"] . '"><br>';
  echo '<label for="hub_name">Hub Name:</label><br>';
  echo '<input type="text" id="hub_name" name="hub_name" value="' . $row["hub_name"] . '"><br>';
  echo '<label for="driver_id">Driver ID:</label><br>';
echo '<input type="text" id="driver_id" name="driver_id" value="' . $row["driver_id"] . '"><br>';
echo '<label for="driver_name">Driver Name:</label><br>';
echo '<input type="text" id="driver_name" name="driver_name" value="' . $row["driver_name"] . '"><br>';
echo '<label for="service_station">Service Station:</label><br>';
echo '<input type="text" id="service_station" name="service_station" value="' . $row["service_station"] . '"><br>';
echo '<label for="damage_type">Damage Type:</label><br>';
echo '<input type="text" id="damage_type" name="damage_type" value="' . $row["damage_type"] . '"><br>';
echo '<label for="deductions">Deductions:</label><br>';
echo '<input type="number" id="deductions" name="deductions" value="' . $row["deductions"] . '"><br>';
echo '<label for="remarks">Remarks:</label><br>';
echo '<textarea id="remarks" name="remarks">' . $row["remarks"] . '</textarea><br>';
echo '<label for="date_sent">Date Sent:</label><br>';
echo '<input type="date" id="date_sent" name="date_sent" value="' . $row["date_sent"] . '"><br>';
echo '<label for="date_received">Date Received:</label><br>';
echo '<input type="date" id="date_received" name="date_received" value="' . $row["date_received"] . '"><br>';
echo '<label for="invoice_number">Invoice Number:</label><br>';
echo '<input type="text" id="invoice_number" name="invoice_number" value="' . $row["invoice_number"] . '"><br>';
echo '<label for="repair_costs">Repair Costs:</label><br>';
echo '<input type="number" id="repair_costs" name="repair_costs" value="' . $row["repair_costs"] . '"><br>';
echo '<label for="insurance_do">Insurance DO:</label><br>';
echo '<input type="number" id="insurance_do" name="insurance_do" value="' . $row["insurance_do"] . '"><br>';
echo '<label for="our_share">Our Share:</label><br>';
echo '<input type="number" id="our_share" name="our_share" value="' . $row["our_share"] . '"><br>';
echo '<label for="month">Month:</label><br>';
echo '<input type="month" id="month" name="month" value="' . $row["month"] . '"><br>';
echo '<br><input type="submit" name="submit" value="Save Changes">';
echo '</form>';
} else {
echo 'No incident found with the specified ID.';
}

