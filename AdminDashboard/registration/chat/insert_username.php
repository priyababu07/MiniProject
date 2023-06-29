<?php
session_start();

// Check if the user ID and username are provided in the POST request
if (isset($_POST['userId']) && isset($_POST['username'])) {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $loggedInUserId = $_SESSION['userId']; // Assuming you have the logged-in user's ID stored in a session variable

    // Connect to the database (replace with your own credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the sender and receiver information into a new table or update an existing table
    $sql = "INSERT INTO messages (sender, receiver) VALUES ('$loggedInUserId', '$userId')";
    if ($conn->query($sql) === TRUE) {
        echo "Sender and receiver information inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
