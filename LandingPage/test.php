<?php
session_start();

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "Paalan");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch scheme options from the database
$sql = "SELECT id, name, description FROM schemes"; // Replace 'schemes' with the table name in your database
$result = mysqli_query($conn, $sql);

// Prepare the data for JSON response
$schemes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $schemes[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sevake Bot</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        /* Add your CSS styles here */
        /* ... */
    </style>
</head>
<body>
    <!-- Your existing HTML code for the dashboard and chart here -->

    <div class="chat-container" id="chat-container">
        <h2>Sevake</h2>
        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="input-container">
            <select id="scheme-dropdown">
                <option value="" disabled selected>Select a scheme</option>
                <?php
                foreach ($schemes as $scheme) {
                    echo '<option value="' . $scheme['id'] . '">' . $scheme['name'] . '</option>';
                }
                ?>
            </select>
            <button id="send-button">Send</button>
        </div>
        <button class="minimize-button" id="minimize-button" onclick="minimizeChatWindow()">&minus;</button>
    </div>

    <div class="chat-button" onclick="openChatWindow()">Chat</div>

    <script>
        // Add your JavaScript code here
        const chatContainer = document.getElementById('chat-container');
        const chatButton = document.getElementsByClassName('chat-button')[0];
        const minimizeButton = document.getElementById('minimize-button');
        const chatMessages = document.getElementById('chat-messages');
        const schemeDropdown = document.getElementById('scheme-dropdown');
        const sendButton = document.getElementById('send-button');

        // Function to open the chat window
        function openChatWindow() {
            chatContainer.style.display = 'block';
        }

        // Function to minimize the chat window
        function minimizeChatWindow() {
            chatContainer.style.display = 'none';
        }

        // Function to display bot messages in the chat window
        function displayBotMessage(message) {
            const botMessage = document.createElement('div');
            botMessage.classList.add('bot-message');
            botMessage.textContent = message;
            chatMessages.appendChild(botMessage);
        }

        // Function to send user message to the server and receive a response
        function sendMessageToServer(message) {
            // Replace this part with your server-side code to process user's message
            // For now, we'll just display the selected scheme's description
            const selectedSchemeId = schemeDropdown.value;
            const selectedScheme = <?php echo json_encode($schemes); ?>.find(scheme => scheme.id === selectedSchemeId);

            if (selectedScheme) {
                displayBotMessage(selectedScheme.description);
            } else {
                displayBotMessage("Invalid selection. Please select a valid scheme.");
            }
        }

        // Event listener for send button click
        sendButton.addEventListener('click', function() {
            const userMessage = schemeDropdown.options[schemeDropdown.selectedIndex].text;
            if (userMessage !== '' && schemeDropdown.value !== "") {
                displayBotMessage("You selected: " + userMessage);
                schemeDropdown.value = "";

                // Scroll to the bottom of the chat container
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Send the user message to the server
                sendMessageToServer(userMessage);
            }
        });

        // Event listener for Enter key press in the input field
        schemeDropdown.addEventListener('change', function() {
            sendButton.click();
        });
    </script>
</body>
</html>
