<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page or display an error message
    header("Location: loginedtd1.php"); // Replace 'loginedtd1.php' with the actual login page URL
    exit;
}

// Get the logged-in username from the session
$username = $_SESSION['username'];

// Include the database configuration file
include("config.php");

// Create a database connection
$con = mysqli_connect("localhost", "root", "", "Paalan");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the Women ID from the parent table
$query = "SELECT woman_id FROM parent WHERE username = '$username'";
$result = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($result)) {
    // Set the 'woman_id' key in the $_SESSION array
    $_SESSION['woman_id'] = $row['woman_id'];
} else {
    // Handle the case where the Women ID is not found
    // Redirect the user or display an error message
    header("Location: error.php"); // Replace 'error.php' with the appropriate error page URL
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Child Details</title>
  <style>
    body {
      background-color: #e9bd0d;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
   
    .worker-card {
      width: 400px;
      background-color: black;
      padding: 20px;
      border-radius: 10px;
      margin: 20px auto;
      text-align: center;
      color: white;
    }
    
    .worker-card h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    
    .worker-card p {
      font-size: 18px;
      margin-bottom: 8px;
    }
    
    .btn {
      display: inline-block;
      background-color: #e9bd0d;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="worker-card">
    <?php
    // Retrieve the worker details based on the provided ID
    $woman_id = $_SESSION['woman_id'];
    $query = "SELECT * FROM child_details WHERE woman_id = '$woman_id'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
      // Display the worker details
      echo "<h1>Child Details</h1>";
      echo "<p><strong>Name:</strong> " . $row['child_name'] . "</p>";
      echo "<p><strong>Age:</strong> " . $row['child_age'] . "</p>";
      echo "<p><strong>Height:</strong> " . $row['height'] . "</p>";
      echo "<p><strong>Weight:</strong> " . $row['weight'] . "</p>";
    } else {
      echo "<p>No child details found.</p>";
    }

    mysqli_close($con);
    ?>

    <a href="javascript:history.back();" class="btn">Go Back</a>
  </div>
</body>

</html>

