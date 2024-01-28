<?php
/**
 * Plugin Name: ChatGPT
 * Description: Adding chatgpt to wordpress theme
 * Version: 1.0
 * Author: Halida i Basila
 */

 add_action('rest_api_init', function () {
    register_rest_route('chatgpt/v1', '/message/', array(
        'methods' => 'POST',
        'callback' => 'handle_chatgpt_request',
    ));
});

function handle_chatgpt_request(WP_REST_Request $request) {
    // Log the request data received
    $request_data = $request->get_json_params(); // Get JSON parameters from the request
    error_log('Request Data: ' . print_r($request_data, true)); // Log the request data

    // Parse the request data
    $message = $request_data['message'] ?? '';

    if (!empty($message)) {
        // Log the parsed message
        error_log('Parsed Message: ' . $message);

        // Send the message to the OpenAI API
        $response = send_message_to_openai($message);
        return new WP_REST_Response($response, 200);
    } else {
        // Log an error if no message provided
        error_log('No message provided');
        return new WP_Error('empty_message', 'No message provided', array('status' => 422));
    }
}

function send_message_to_openai($message) {
    $api_key = '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';
    $ch = curl_init('https://api.openai.com/v1/chat/completions'); // Update the URL to the desired model's endpoint

    $data = array(
        'model' => 'gpt-3.5-turbo',
        'messages' => array(
            array(
                'role' => 'user',
                'content' => $message,
            ),
        )
    );
    
    $temp = json_encode($data);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}