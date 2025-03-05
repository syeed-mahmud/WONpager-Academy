<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

// Get username for personalization
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WONpager Assistant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        
        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }
        
        .message {
            max-width: 80%;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 15px;
            word-wrap: break-word;
        }
        
        .user-message {
            align-self: flex-end;
            background-color: #DCF8C6;
            border-bottom-right-radius: 5px;
        }
        
        .bot-message {
            align-self: flex-start;
            background-color: #E0E0E0;
            border-bottom-left-radius: 5px;
        }
        
        .input-container {
            display: flex;
            padding: 10px;
            background-color: white;
            border-top: 1px solid #ddd;
        }
        
        #userInput {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
            margin-right: 10px;
        }
        
        .send-button {
            background-color: #00233F;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .welcome-message {
            text-align: center;
            margin: 20px 0;
            color: #666;
        }

        .typing-indicator {
            display: none;
            align-self: flex-start;
            margin-bottom: 10px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="messages-container" id="messagesContainer">
            <div class="welcome-message">
                <p>Hello <?php echo htmlspecialchars($username); ?>! How can I help you today?</p>
            </div>
            <div class="message bot-message">
                I'm your WONpager Assistant. You can ask me questions about modules, features, or how to use the platform.
            </div>
            <div class="typing-indicator" id="typingIndicator">Assistant is typing...</div>
        </div>
        <div class="input-container">
            <input type="text" id="userInput" placeholder="Type your message here...">
            <button class="send-button" id="sendBtn">➤</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messagesContainer = document.getElementById('messagesContainer');
            const userInput = document.getElementById('userInput');
            const sendBtn = document.getElementById('sendBtn');
            const typingIndicator = document.getElementById('typingIndicator');
            
            // Function to add a message to the chat
            function addMessage(content, isUser) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
                messageDiv.textContent = content;
                messagesContainer.appendChild(messageDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Function to send message to the chatbot
            async function sendMessage() {
                const message = userInput.value.trim();
                if (message === '') return;
                
                // Add user message to chat
                addMessage(message, true);
                userInput.value = '';
                
                // Show typing indicator
                typingIndicator.style.display = 'block';
                
                try {
                    // Send request to the chatbot backend
                    const response = await fetch('chatbot-backend.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `message=${encodeURIComponent(message)}`
                    });
                    
                    const data = await response.json();
                    
                    // Hide typing indicator
                    typingIndicator.style.display = 'none';
                    
                    // Add bot response to chat
                    addMessage(data.response, false);
                } catch (error) {
                    console.error('Error:', error);
                    typingIndicator.style.display = 'none';
                    addMessage('Sorry, I encountered an error. Please try again later.', false);
                }
            }
            
            // Event listeners
            sendBtn.addEventListener('click', sendMessage);
            
            userInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
</body>
</html>
