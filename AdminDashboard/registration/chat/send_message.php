<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender = $_POST['sender'];
  $message = $_POST['message'];
  
  // Save the message to the database
  $conn = mysqli_connect("localhost", "root", "", "chat");
  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $query = "INSERT INTO messages (sender, message) VALUES ('$sender', '$message')";
  
  if (mysqli_query($conn, $query)) {
    echo "Message sent successfully.";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
}
?>
