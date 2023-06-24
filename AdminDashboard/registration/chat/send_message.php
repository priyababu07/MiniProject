<?php
// Check if the message parameter is present
if (isset($_POST['message'])) {
    $message = $_POST['message'];

    // Database connection details
    $host = 'localhost';
    $dbname = 'chat';
    $username = 'root';
    $password = '';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO messages (message) VALUES (?)");

        // Bind the message parameter to the SQL statement
        $stmt->bindParam(1, $message);

        // Execute the SQL statement
        $stmt->execute();

        // Close the database connection
        $pdo = null;

        // Send a success response
        echo "Message stored successfully";
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>

