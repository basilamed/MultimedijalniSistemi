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