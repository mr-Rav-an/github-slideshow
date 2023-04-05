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

        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome " ?></a>
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
        <th>Insurance Partner</th>
        <th>Received DOs</th>
        <th>Pending DOs</th>
        <th>Adress</th>
        <th>Contact</th>
        <th>Contact Person</th>
       
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
        $sql = "SELECT * FROM insurance";

        // Execute the query and store the results in $result
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
          // Loop through each row of data
          while ($row = $result->fetch_assoc()) {
            // Print the data in a table row
            echo '<tr>';
            echo '<td>' . $row['insurance_partner'] . '</td>';
            echo '<td>' . $row['Received_DOs'] . '</td>';
            echo '<td>' . $row['Pending_DOs'] . '</td>';
            echo '<td>' . $row['Adress'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
            echo '<td>' . $row['contact_person'] . '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="16">No Data found.</td></tr>';
        }

        // Close the database connection
        $conn->close();
      ?>
    </tbody>
  </table>
</div>