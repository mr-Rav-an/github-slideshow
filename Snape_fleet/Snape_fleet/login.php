<?php
// This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: welcome.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username + password";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    if (empty($err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) ==1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    // Verify the password
                    if ($password == $hashed_password) {
                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: welcome.php");
                        exit;
                    } else {
                        $err = "Incorrect password";
                    }
                }
            } else {
                $err = "Incorrect username";
            }
        } else {
            $err = "Error executing statement";
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>
</form>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet login</title>
</head>
<body>
   
    <form action="" method="post">
        <h1>Wellcome to SnapE Fleet Manager</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    
        <input type="submit" value="Log In">

        <style>
            form {
                background-color: #ec5d5d;
                padding: 50px;
                border-radius: 20px;
                margin-top: 50px;
                margin-bottom: 10px;
                margin-left: 300px;
                margin-right: 300px;
            }
            h1{
                display: -moz-inline-stack;
                margin-bottom: 20px;
                margin-top: 1px;
                margin-left: 20;
                min-height: 10px;
            }
        
            label {
                display: inline-block;
                margin-bottom: 10px;
               
            }
        
            input[type="text"], input[type="password"] {
                padding: 10px;
                border: 1px solid #0eae06;
                border-radius: 7px;
                margin-bottom: 20px;
                margin-left:1px;
                margin-right: 50px;
                width: 100%;
            }
        
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }
        </style>
    </form>
</body>
</html>