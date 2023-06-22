<!DOCTYPE html>
<html>
<head>
  <title>Anganwadi Worker Approval</title>
  <style>
    /* CSS styles for the table and buttons */
  </style>
</head>
<body>
<?php
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "AganwadiWorker");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process approval
if (isset($_GET['approve'])) {
    $workerId = $_GET['approve'];
    $approveQuery = "SELECT * FROM worker_registration WHERE id = $workerId";
    $approveResult = mysqli_query($conn, $approveQuery);

    if (mysqli_num_rows($approveResult) > 0) {
        $row = mysqli_fetch_assoc($approveResult);

        // Insert approved worker into the worker_approval table
        $insertQuery = "INSERT INTO worker_approval (name, score) VALUES ('" . $row['name'] . "', " . $row['score'] . ")";
        
        mysqli_query($conn, $insertQuery);

        $deleteQuery = "DELETE FROM worker_registration WHERE id = $workerId";
        mysqli_query($conn, $deleteQuery);
        



        if (mysqli_query($conn, $insertQuery)) {
            // Send email to the person
           // Update with your email address
            $to = $row['email'];
            $subject = "Congratulations! You have been approved";
            $message = "Dear " . $row['name'] . ",\n\nCongratulations! You have been approved to work in Anganwadi number " . $row['place'] . ". We appreciate your dedication and look forward to your contributions.\n\nBest regards,\nThe Anganwadi Team";
            $headers = 'From: sender@example.com' . "\r\n" .
            'Reply-To: sender@example.com' . "\r\n" .
        '    X-Mailer: PHP/' . phpversion();
            // Send the email
            if (mail($to, $subject, $message, $headers)) {
                echo "Worker details entered, approval email sent successfully, and Anganwadi information provided";
            } else {
                echo "Worker details entered, failed to send the approval email, but Anganwadi information provided";
            }

            // Delete worker from the worker_registration table
            $deleteQuery = "DELETE FROM worker_registration WHERE id = $workerId";
            mysqli_query($conn, $deleteQuery);
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }
}
        



      
  

// Process rejection
if (isset($_GET['reject'])) {
    $workerId = $_GET['reject'];

    // Delete worker from the worker_details table
    $deleteQuery = "DELETE FROM worker_registration WHERE id = $workerId";
    mysqli_query($conn, $deleteQuery);
}

// Retrieve worker details for the approval table
$approvalQuery = "SELECT id, name, score FROM worker_registration ORDER BY score DESC";
$approvalResult = mysqli_query($conn, $approvalQuery);
?>

<!-- Display the approval table -->
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Score</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($approvalResult)): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['score']; ?></td>
        <td>
          <a href="?approve=<?php echo $row['id']; ?>">Approve</a>
          <a href="?reject=<?php echo $row['id']; ?>">Reject</a>
          <a href="?view=<?php echo $row['id']; ?>">View Details</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
// Process viewing of worker details
if (isset($_GET['view'])) {
    $workerId = $_GET['view'];
    $viewQuery = "SELECT * FROM worker_registration WHERE id = $workerId";
    $viewResult = mysqli_query($conn, $viewQuery);

    if (mysqli_num_rows($viewResult) > 0) {
        $row = mysqli_fetch_assoc($viewResult);
        ?>
        <!-- Display the worker details -->
        <h2>Worker Details</h2>
        <p>ID: <?php echo $row['id']; ?></p>
        <p>Name: <?php echo $row['name']; ?></p>
        <p>Age: <?php echo $row['age']; ?></p>
        <p>Address: <?php echo $row['address']; ?></p>
        <p>Phone: <?php echo $row['phone']; ?></p>
        <p>Email: <?php echo $row['email']; ?></p>
        <p>Education Qualification: <?php echo $row['education']; ?></p>
        <p>Test Score: <?php echo $row['score']; ?></p>
        <p>Place: <?php echo $row['place']; ?></p>
        <?php
    }
}

mysqli_close($conn);
?>
</body>
</html>
