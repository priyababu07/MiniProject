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

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all pending stock requests
$sql = "SELECT * FROM workers";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output the stock requests in a table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Score</th>
                <th>Place</th>
                <th>Action</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['age'] . "</td>
                <td>" . $row['score'] . "</td>
                <td>" . $row['place'] . "</td>
                <td>
                    <form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
                        <input type='hidden' name='request_id' value='" . $row['id'] . "'>
                        <button type='submit' name='approve' class='approve'>Approve</button>
                        <button type='submit' name='reject' class='reject'>Reject</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No pending stock requests.";
}

// Process the approval or rejection of stock requests
if (isset($_POST['approve']) || isset($_POST['reject'])) {
    $requestId = $_POST['request_id'];
    $status = isset($_POST['approve']) ? 'approved' : 'rejected';

    // Update the status of the stock request using prepared statements
    $updateSql = "UPDATE workers SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($stmt, "si", $status, $requestId);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Stock request " . $status . " successfully.</p>";

        // If the request is approved, insert it into the stock_approved table
        if ($status === "approved") {
            $selectSql = "SELECT * FROM workers WHERE id = ?";
            $stmt = mysqli_prepare($conn, $selectSql);
            mysqli_stmt_bind_param($stmt, "i", $requestId);
            mysqli_stmt_execute($stmt);
            $selectResult = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($selectResult) > 0) {
                $selectRow = mysqli_fetch_assoc($selectResult);

                $name = $selectRow['name'];
                $age = $selectRow['age'];
                $score = $selectRow['score'];
                $place = $selectRow['place'];

                // Prepare and execute the insert statement for stock_approved table
                $insertSql = "INSERT INTO newworkers (name, age, score, place) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertSql);
                mysqli_stmt_bind_param($stmt, "siss", $name, $age, $score, $place);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>Approved submission inserted into stock_approved table.</p>";

                    // Delete the approved request from the workers table
                    $deleteSql = "DELETE FROM workers WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $deleteSql);
                    mysqli_stmt_bind_param($stmt, "i", $requestId);
                    mysqli_stmt_execute($stmt);
                } else {
                    echo "<p>Error inserting data into stock_approved table: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "";
            }
        } else {
            // If the request is rejected, delete it from the workers table
            $deleteSql = "DELETE FROM workers WHERE id = ?";
            $stmt = mysqli_prepare($conn, $deleteSql);
            mysqli_stmt_bind_param($stmt, "i", $requestId);
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Stock request rejected and removed from the table.</p>";
            } else {
                echo "<p>Error deleting stock request: " . mysqli_error($conn) . "</p>";
            }
        }
        echo "<script>
                setTimeout(function() {
                    location.reload();
                }, 2000); // Refresh the page after 2 seconds (2000 milliseconds)
            </script>";
    } else {
        echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
    }
}

// Close the database connection
mysqli_close($conn);
?>


                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        // Listen for click on status buttons
                        $('.status-button').click(function() {
                            var submissionId = $(this).data('submission-id');
                            var status = $(this).data('status');

                            // Send AJAX request to update the approval status
                            $.ajax({
                                type: 'POST',
                                url: 'approve.php',
                                data: { submissionId: submissionId, status: status },
                                success: function(response) {
                                    console.log(response);
                                    // Handle success response if needed
                                },
                                error: function(error) {
                                    console.log(error);
                                    // Handle error gracefully if needed
                                }
                            });
                        });
                    });
                    </script>

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
