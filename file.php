<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secretKey = "0x4AAAAAABCMagE2HHH7hqSsKOTIKeUfkhg";
    $response = $_POST["cf-turnstile-response"];

    $url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
    $data = [
        "secret" => $secretKey,
        "response" => $response
    ];

    $options = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $responseData = json_decode($result);

    if ($responseData->success) {
        echo "CAPTCHA Verification Passed!";
        // Process login
    } else {
        echo "CAPTCHA Verification Failed!";
    }
}
?>
