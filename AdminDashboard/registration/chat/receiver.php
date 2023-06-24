<?php
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

    // Fetch all messages from the database
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection
    $pdo = null;
} catch (PDOException $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat System - Receiver</title>
    <style>
          body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.chat-container {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.chat-header {
    background-color: #075e54;
    color: #fff;
    padding: 10px;
    text-align: center;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.chat-messages {
    height: 300px;
    padding: 10px;
    overflow-y: scroll;
}

.chat-input {
    display: flex;
    align-items: center;
    padding: 10px;
}

.chat-input select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

/* .chat-input button {
    padding: 8px 16px;
    background-color: #128c7e;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
} */

.chat-message {
    margin-bottom: 10px;
}

.sender {
    text-align: right;
    background-color: #ff8080;
}

.receiver {
    text-align: left;
    background-color: #99ff99;
}

.stock-available {
    background-color: #99ff99;
}

.stock-defect {
    background-color: #ff8080;
}

.stock-unavailable {
    background-color: #ffff99;
}

.button-container {
            display: flex;
            align-items: center;
        }

        .button {
            padding: 5px 10px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .defect-button {
            background-color: #ff8080;
            color: #fff;
        }

        .available-button {
            background-color: #99ff99;
            color: #000;
        }

        .unavailable-button {
            background-color: #ffff99;
            color: #000;
        }

        
        .message {
            width: 150px;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
        }

        .defect {
            background-color: #ff8080;
        }

        .available {
            background-color: #99ff99;
        }

        .unavailable {
            background-color: #ffff99;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h2>Chat System - Receiver</h2>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Display the messages -->
            <?php foreach ($messages as $message): ?>
                <div class="message <?php echo $message['message']; ?>">
                    <?php echo $message['message']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
