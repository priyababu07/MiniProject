<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "registration";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch stock availability from the database
function getStockAvailability($panchayath) {
    global $conn;

    // Prepare the SQL query
    $sql = "SELECT stock_available FROM stock_availability WHERE panchayath = '$panchayath'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the stock availability
        $row = $result->fetch_assoc();
        $stockAvailability = $row['stock_available'];

        // Return the stock availability
        return $stockAvailability;
    } else {
        // Return null if no stock availability found
        return null;
    }
}

// Function to handle user messages and generate responses
function handleMessage($message) {
    // Predefined keywords and their corresponding responses
    $keywords = array(
        'hai' => 'Hello, My name is Gayathri. Do you want to know whether stock is available in your panchayath?',
        'help' => 'Sure, I can help you with information about Stock availability in your panchayath.',
        'thank you' => 'You\'re welcome!',
    );

    // Check if the message contains any predefined keywords
    foreach ($keywords as $keyword => $response) {
        if (stripos($message, $keyword) !== false) {
            return array("response" => $response, "isStockAvailable" => false);
        }
    }

    // If no predefined keyword matched, assume the message is a panchayath name
    $panchayath = trim($message);
    $stockAvailability = getStockAvailability($panchayath);

    if ($stockAvailability !== null && $stockAvailability == 'yes') {
        // Stock available
        $response = "Stock is available";
        return array("response" => $response, "isStockAvailable" => true);
    } else {
        // Stock not available
        $response = "Stock is not available";
        return array("response" => $response, "isStockAvailable" => false);
    }
}

// Handle user input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $userMessage = $_POST['message'];

    // Process the message and generate a response
    $botResponse = handleMessage($userMessage);

    // Return the response as JSON
    echo json_encode($botResponse);
    exit; // Terminate the script after sending the response
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Bot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f4f4f4;
            border-radius: 5px;
            padding: 20px;
        }

        .chat-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .chat-messages {
            background-color: #fff;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }

        .message-container {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .user-message-container {
            justify-content: flex-end;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            max-width: 70%;
        }

        .user-message {
            background-color: #f1f1f1;
        }

        .bot-message {
            background-color: black;
            color:black;
        }

        .bot-message-available {
            background-color: #8bc34a;
        }

        .bot-message-not-available {
            background-color: #ffeb3b;
           
        }

        .input-container {
            display: flex;
        }

        .input-container input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-container button {
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
    <div class="chat-container">
        <h2>Chat Bot</h2>
        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="input-container">
            <input type="text" id="message-input" placeholder="Enter your Panchayath" required>
            <button id="send-button">Send</button>
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');

        // Function to display user messages in the chat window
        function displayUserMessage(message) {
            const userMessageContainer = document.createElement('div');
            userMessageContainer.classList.add('message-container', 'user-message-container');

            const userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user-message');
            userMessage.textContent = message;

            userMessageContainer.appendChild(userMessage);
            chatMessages.appendChild(userMessageContainer);
        }

        // Function to display bot messages in the chat window
        function displayBotMessage(message, isStockAvailable) {
            const botMessageContainer = document.createElement('div');
            botMessageContainer.classList.add('message-container', 'bot-message-container');

            const botMessage = document.createElement('div');
            botMessage.classList.add('message', 'bot-message');

            if (isStockAvailable) {
                botMessage.classList.add('bot-message-available');
            } else {
                botMessage.classList.add('bot-message-not-available');
            }

            botMessage.textContent = message;

            botMessageContainer.appendChild(botMessage);
            chatMessages.appendChild(botMessageContainer);
        }

        // Function to send user message to the server and receive a response
        function sendMessageToServer(message) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    displayBotMessage(response.response, response.isStockAvailable);
                }
            };

            const data = 'message=' + encodeURIComponent(message);
            xhr.send(data);
        }

        // Event listener for send button click
        sendButton.addEventListener('click', function() {
            const userMessage = messageInput.value.trim();
            if (userMessage !== '') {
                displayUserMessage(userMessage);
                messageInput.value = '';

                // Scroll to the bottom of the chat container
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Send the user message to the server
                sendMessageToServer(userMessage);
            }
        });

        // Event listener for Enter key press in the input field
        messageInput.addEventListener('keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                sendButton.click();
            }
        });
    </script>
</body>
</html>




