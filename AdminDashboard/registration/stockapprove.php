<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Approval</title>
    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $stock_item = $_POST['stock_item'];
        $quantity = $_POST['quantity'];
        $defect_details = $_POST['defect_details'];

        // Create a database connection
        $conn = mysqli_connect("localhost", "root", "", "Stock");

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL statement to insert data into the database
        $sql = "INSERT INTO StockRequest (stock_item, quantity, defect_details)
                VALUES ('$stock_item', $quantity, '$defect_details')";

        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            echo "Stock request placed successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
    
        .navbar {
            background-color: #333;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }
    
        .navbar h1 {
            margin: 0;
        }
    
        .sidebar {
            width: 180px;
            background-color: #f4f4f4;
            padding: 15px;
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
        }
    
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    
        .sidebar li {
            margin-bottom: 10px;
        }
    
        .sidebar a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
    
        .sidebar a:hover {
            background-color: #555;
            color: #fff;
        }
    
        .main-content {
            margin-left: 200px;
            padding: 20px;
            margin-top: 70px;
        }
    
        h1 {
            margin-top: 0;
        }
    
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
    
        label {
            display: block;
            margin-bottom: 10px;
        }
    
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
    
        textarea {
            height: 80px;
        }
    
        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #e5bf16;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Paalan</h1>
    </div>

    <div class="sidebar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Stocks</a></li>
            <li><a href="#">Orders</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Stock Request Approval</h1>
        <?php
        // Create a database connection
        $conn = mysqli_connect("localhost", "root", "", "Stock");

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch all pending stock requests
        $sql = "SELECT * FROM stock_requests WHERE status = 'pending'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output the stock requests in a table
            echo "<table>
                    <tr>
                        <th>Stock Item</th>
                        <th>Quantity</th>
                        <th>Defect Details</th>
                        <th>Action</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['stock_item'] . "</td>
                        <td>" . $row['quantity'] . "</td>
                        <td>" . $row['defect_details'] . "</td>
                        <td>
                            <form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
                                <input type='hidden' name='request_id' value='" . $row['id'] . "'>
                                <button type='submit' name='approve'>Approve</button>
                                <button type='submit' name='reject'>Reject</button>
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

            // Update the status of the stock request
            $updateSql = "UPDATE StockRequest SET status = '$status' WHERE id = $requestId";
            if (mysqli_query($conn, $updateSql)) {
                echo "<p>Stock request " . $status . " successfully.</p>";
            } else {
                echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
