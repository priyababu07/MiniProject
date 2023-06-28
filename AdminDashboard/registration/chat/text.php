<?php
session_start();

$chat_username = $_SESSION['username'];

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

// Prepare the SQL statement to insert the username
$stmt = $conn->prepare("INSERT INTO messages (sender) VALUES (?)");
$stmt->bind_param("s", $chat_username);
$stmt->execute();

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Select User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            background-color: #075e54;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin: 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card {
            padding: 20px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .start-chat-button {
            padding: 5px 10px;
            background-color: #25D366;
            border: none;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 3px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="container">
    <h2><?php echo $_SESSION['chat_username']; ?></h2>

    <div class="card">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="dropdown-container">
                <label for="username">Select a user:</label>
                <select name="username" id="username">
                    <?php
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

                    // Fetch usernames from the users table
                    $sql = "SELECT username FROM users";
                    $result = $conn->query($sql);

                    // Display usernames as options in the dropdown menu
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                        }
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </select>
            </div>

            <button type="submit" class="lets-chat-button">Insert Name</button>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the selected username
        $selectedUsername = $_POST['username'];

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

        // Insert the selected username into the database table
        $stmt = $conn->prepare("INSERT INTO messages(receiver) VALUES (?)");
        $stmt->bind_param("s", $selectedUsername);
        $stmt->execute();

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        echo "<div class='card'>Selected username ('$selectedUsername') has been inserted into the database table.</div>";
    }
    ?>

    <script>
        function startChat(userId) {
            // You can implement your logic here to handle the "Start Chat" button click
            // For example, redirect to a chat page with the selected user ID
            window.location.href = 'chatarea.php?userId=' + userId;
        }
    </script>
</div>
</body>
</html>


    <script>
        function startChat(userId) {
            // You can implement your logic here to handle the "Start Chat" button click
            // For example, redirect to a chat page with the selected user ID
            window.location.href = 'chatarea.php?userId=' + userId;
        }
        document.addEventListener("DOMContentLoaded", function () {
    var selectUser = document.getElementById("username");
    var selectedUsername = ""; // Variable to store the selected username

    selectUser.addEventListener("change", function () {
        selectedUsername = selectUser.value;
    });
});
    </script>
</div>
</body>
</html>


