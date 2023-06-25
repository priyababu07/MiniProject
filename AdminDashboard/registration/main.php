<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>Paa</span>lan</p>
        <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
        <a href="agw.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Aganwadi Worker Details</a>
        <a href="pgw.php"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Preganant Women Details</a>
        <a href="child.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Child Detail</a>
        <a href="stockapprove.php"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Stock Request</a>
        <a href="#"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
        
    </div>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Dashboard</span>
            </div>
            <div class="col-div-6">
            <div class="dropdown">
            <div class="profile"><span id="account-icon" class="material-icons-outlined account-icon" style="margin-left: 450px; font-size: 45px;">account_circle</span>
        
            
            <div class="dropdown-content" for="account-icon">
                <a href="logout.php">Log out</a>
                <a href="changepassword.php">Change Password</a>
            </div>
        </div>
                    <span class="username" style="margin-right:1000px;" >
                        
                        <?php 
                        echo $_SESSION['username']; 
                        ?>
                        
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
       
        <div class="col-div-3">
            <div class="box">
            <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM AGW";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
            <p><?php echo $totalCount; ?><br/><span>Workers</span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
    <div class="box">
        <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM pregnant_women";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
        <p><?php echo $totalCount; ?><br/><span>Pregnant women</span></p>
        <i class="fas fa-plus box-icon box-icon"></i>
    </div>
</div>

        <div class="col-div-3">
            <div class="box">
            <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM pregnant_women";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
                <p><?php echo $totalCount; ?><br/><span>LactatingWomen</span></p>
                <i class="fas fa-female box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
            <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM Child";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
                <p><?php echo $totalCount; ?><br/><span>Childrens</span></p>
                <i class="fas fa-child box-icon"></i>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/><br/>
        <div class="col-div-8">
            <div class="box-8">
                <div class="content-box">
                    <p>Approval Board </p>
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

                </div>
            </div>
        </div>
         

        <div class="col-div-4">
            <div class="box-4">
                <div class="content-box">
                    <p>Total Stock Provided </p>

                    <div class="circle-wrap">
                        <div class="circle">
                            <div class="mask full">
                                <div class="fill"></div>
                            </div>
                            <div class="mask half">
                                <div class="fill"></div>
                            </div>
                            <div class="inside-circle"> 70% </div>
                        </div>
                    </div>
                </div>
                </div>
               </html>
