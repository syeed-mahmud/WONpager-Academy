<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Initialize chat history if it doesn't exist
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Check if we received a message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $userMessage = trim($_POST['message']);
    
    // Add user message to chat history
    $_SESSION['chat_history'][] = ['role' => 'user', 'content' => $userMessage];
    
    // Prepare the API call to Groq
    $apiKey = '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';
    $model = 'deepseek-r1-distill-llama-70b';
    
    // Prepare messages for the API
    $messages = $_SESSION['chat_history'];
    
    // Make the API call
    $response = callGroqAPI($apiKey, $model, $messages);
    
    // Process the response
    if (isset($response['choices'][0]['message']['content'])) {
        $botResponse = $response['choices'][0]['message']['content'];
        
        // Remove "thinking" text if present
        if (strpos($botResponse, '<think>') !== false && strpos($botResponse, '</think>') !== false) {
            $parts = explode('</think>', $botResponse);
            $botResponse = trim(end($parts));
        }
        
        // Add bot response to chat history
        $_SESSION['chat_history'][] = ['role' => 'assistant', 'content' => $botResponse];
        
        // Return the response
        header('Content-Type: application/json');
        echo json_encode(['response' => $botResponse]);
    } else {
        // Handle error
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to get response from chatbot', 'details' => $response]);
    }
} else {
    // Invalid request
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid request']);
}

/**
 * Function to call the Groq API
 */
function callGroqAPI($apiKey, $model, $messages) {
    $url = 'https://api.groq.com/openai/v1/chat/completions';
    
    $data = [
        'model' => $model,
        'messages' => $messages,
        'max_tokens' => 500
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return ['error' => $error];
    }
    
    return json_decode($response, true);
}
