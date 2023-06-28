<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paalan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn == false) {
    die("connection error");
}
// Fetch data from the 'child_details' table
$query = "SELECT * FROM child_details";
$result = mysqli_query($conn, $query);
?>
