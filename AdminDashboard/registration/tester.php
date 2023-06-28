<!DOCTYPE html>
<html>
<head>
    <title>Stock Availability</title>
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

        .container {
            padding: 20px;
            margin-top: 150px;
            background-color: #fff;
            border-radius: 5px;
        }

        .container h1 {
            margin-top: 0;
        }

        .container p {
            margin-bottom: 10px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <p class="logo"><span>Paa</span>lan</p>
    </div>

    <div class="sidebar">
        <ul>
            <li><a href="main.php">Home</a></li>
        </ul>
    </div>
<center>
    <div class="container">
        <h1>Stock Availability</h1>

        <?php
        $conn = new mysqli("localhost", "root", "", "registration");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stockAvailable = $_POST['stock_available'];
            $panchayat = $_POST['panchayat'];
            $stockItem = $_POST['stock_item'];

            // Insert data into the table
            $sql = "INSERT INTO stock_availability (stock_available, panchayat, stock_item)
                    VALUES ('$stockAvailable', '$panchayat', '$stockItem')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Data inserted successfully</p>";
            } else {
                echo "Error inserting data: " . $conn->error;
            }

            echo "<p>Stock availability: $stockAvailable</p>";
            echo "<p>Panchayat: $panchayat</p>";
            echo "<p>Stock item: $stockItem</p>";
        }
        ?>

        <form method="POST">
            <label>
                Is the stock available?
                <select name="stock_available">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </label>
            <br><br>
            <label>
                Panchayath:
                <input type="text" name="panchayat" required>
            </label>
            <br><br>
            <label>
                Stock Item:
                <input type="text" name="stock_item" required>
            </label>
            <br><br>
            <button type="submit">Submit</button>
        </form>
    </div>
    </center>
</body>
</html>



