<?php
// Create a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "snape_fleet";

$conn = new mysqli($servername,$username,$password,$dbname);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    // Retrieve the data from the form
    $incident_date = $_POST['incident_date'];
    $vehicle_number = $_POST['vehicle_number'];
    $hub_name = $_POST['hub_name'];
    $driver_id = $_POST['driver_id'];
    $driver_name = $_POST['driver_name'];
    $service_station = $_POST['service_station'];
    $damage_type = $_POST['damage_type'];
    $deductions = $_POST['deductions'];
    $remarks = $_POST['remarks'];
    $date_sent = $_POST['date_sent'];
    $date_received = $_POST['date_received'];
    $invoice_number = $_POST['invoice_number'];
    $repair_costs = $_POST['repair_costs'];
    $insurance_do = $_POST['insurance_do'];
    $our_share = $_POST['our_share'];
    $month = $_POST['month'];

    // Prepare the SQL statement
    $sql = "INSERT INTO incidents (incident_date, vehicle_number, hub_name, driver_id, driver_name, service_station, damage_type, deductions, remarks, date_sent, date_received, invoice_number, repair_costs, insurance_do, our_share, month) 
    VALUES ('$incident_date', '$vehicle_number', '$hub_name', '$driver_id', '$driver_name', '$service_station', '$damage_type', '$deductions', '$remarks', '$date_sent', '$date_received', '$invoice_number', '$repair_costs', '$insurance_do', '$our_share', '$month')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<style>
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
  }
  
  h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .table {
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
  }
  
  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border: 1px solid #ccc;
  }
  
  .table thead th {
    background-color: #eee;
    vertical-align: middle;
  }
  
  .table tbody + tbody {
    border-top: 2px solid #ccc;
  }
  
  .table tbody tr:hover {
    background-color: #f5f5f5;
  }
  
  .table tbody tr:nth-child(even) {
    background-color: #fafafa;
  }
  
  .table tbody td:nth-child(7) {
    color: #ff5722;
  }
  
  .table tbody td:last-child {
    text-align: center;
  }
  
  .table tbody td:first-child {
    font-weight: bold;
  }
  
  .table tbody td:nth-child(n+2):nth-child(-n+6) {
    text-transform: uppercase;
  } 

    
  .table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: #fff;
    border-collapse: collapse;
  }
  
  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
  }
  
  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
  }
  
  .table tbody + tbody {
    border-top: 2px solid #dee2e6;
  }
</style>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>SnapE Fleet Manager</title>
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
                <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
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
                <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome "  ?></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
  <h3>Update Incident Details</h3>
  <form method="post" action="">
    <div class="form-group">
      <label for="incident-date">Incident Date</label>
      <input type="text" class="form-control" id="incident_date" name="incident_date" required>
    </div>
    <div class="form-group">
      <label for="vehicle_number">Vehicle Number</label>
      <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
    </div>
    <div class="form-group">
      <label for="hub_name">Hub Name</label>
      <input type="text" class="form-control" id="hub_name" name="hub_name" required>
    </div>
    <div class="form-group">
      <label for="driver_id">Driver ID</label>
      <input type="text" class="form-control" id="driver_id" name="driver_id" required>
    </div>
    <div class="form-group">
      <label for="driver_name">Driver Name</label>
      <input type="text" class="form-control" id="driver_name" name="driver_name" required>
    </div>
    <div class="form-group">
      <label for="service_station">Service Station</label>
      <input type="text" class="form-control" id="service_station" name="service_station" required>
    </div>
    <div class="form-group">
      <label for="damage_type">Damage Type</label>
      <input type="text" class="form-control" id="damage_type" name="damage_type" required>
    </div>
    <div class="form-group">
      <label for="deductions">Deductions</label>
      <input type="text" class="form-control" id="deductions" name="deductions">
    </div>
    <div class="form-group">
      <label for="remarks">Status</label>
      <input type="text" class="form-control" id="remarks" name="remarks">
    </div>
    <div class="form-group">
      <label for="date_sent">Date Sent</label>
      <input type="text" class="form-control" id="date_sent" name="date_sent" required>
    </div>
    <div class="form-group">
      <label for="date_received">Date Received</label>
      <input type="text" class="form-control" id="date_received" name="date_received" required>
    </div>
    <div class="form-group">
      <label for="invoice_number">Invoice Number</label>
      <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
    </div>
    <div class="form-group">
      <label for="repair_costs">Repair Costs</label>
      <input type="text" class="form-control" id="repair_costs" name="repair_costs" required>
    </div>
    <div class="form-group">
      <label for="insurance_do">Insurance DO</label>
      <input type="text" class="form-control" id="insurance_do" name="insurance_do" required>
    </div>
    <div class="form-group">
      <label for="our_share">Our Share</label>
      <input type="text" class="form-control" id="our_share" name="our_share" required>
    </div>
    <div class="form-group">
      <label for="month">Month</label>
      <input type="text" class="form-control" id="month" name="month" required>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
  <label for="photo1">Photo 1:</label>
  <input type="file" name="photo1" id="photo1"><br>

  <label for="photo2">Photo 2:</label>
  <input type="file" name="photo2" id="photo2"><br>

  <label for="photo3">Photo 3:</label>
  <input type="file" name="photo3" id="photo3"><br>

  <label for="photo4">Photo 4:</label>
  <input type="file" name="photo4" id="photo4"><br>

 
    <input class="btn btn-primary" name="submit" type="submit" value="Submit">
    </form>
    </form>
<script>
    // select the form and submit button elements
const form = document.querySelector('#myForm');
const submitBtn = document.querySelector('#submitBtn');

// add a click event listener to the submit button
submitBtn.addEventListener('click', (e) => {
  // prevent the default form submission behavior
  e.preventDefault();
  
  // get the form data
  const formData = new FormData(form);
  
  // send the form data to the server using fetch
  fetch('/submit', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    // handle the response from the server
    console.log(response);
  })
  .catch(error => {
    // handle any errors
    console.error(error);
  });
});
<script/>