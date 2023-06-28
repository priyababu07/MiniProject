<!DOCTYPE html>
<html>
<head>
    <title>Approved Stocks</title>
    <style>
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
        table {
            border-collapse: collapse;
            width: 60%;
            
            margin-top: 70px; 
            
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="navbar">
    <p class="logo"><span>Paa</span>lan</p>
    </div>

    <div class="sidebar">
        <ul>
            <li><a href="stockapprove.php">Home</a></li>
    </div>  
        </ul>
        <center>
    <h1>Approved Stocks</h1>

    <table>
        <tr>
            <th>id</th>
            <th>Stock item</th>
            <th>Quantity</th>
            <th>Approval Date</th>
        </tr>
        <?php
        // Establish database connection
        $conn = new mysqli("localhost", "root", "", "Stock");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the "stock approval" table
        $sql = "SELECT id, stock_item,quantity,approval_date FROM stock_approved";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["stock_item"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["approval_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No approved stocks found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
    </center>
</body>
</html>
