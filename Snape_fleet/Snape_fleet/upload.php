
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
    // Upload the first photo
$image1 = $_FILES['image1'];


// Upload the second photo
$image2 = $_FILES['image2'];


// Upload the third photo
$image3 = $_FILES['image3'];
;

// Upload the fourth photo
$image4 = $_FILES['image4'];


$sql = "INSERT INTO incidents ( image1, image2, image3, image4) 
VALUES ('$image1', '$image2', '$image3', '$image4')";
if (mysqli_query($conn, $sql)) {
    echo "Record added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
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