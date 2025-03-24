<?php

// Define allowed redirect paths (whitelist)
$allowedPaths = [
    "/home.php",
    "/dashboard.php",
    "/profile.php"
];

if (array_key_exists("redirect", $_GET) && !empty($_GET["redirect"])) {
    $redirectUrl = $_GET["redirect"];

    // Prevent header injection
    $redirectUrl = str_replace(["\r", "\n"], '', $redirectUrl);

    // Validate against allowed paths
    if (in_array($redirectUrl, $allowedPaths, true)) {
        header("Location: " . $redirectUrl, true, 302);
        exit;
    } else {
        // Invalid redirect
        http_response_code(400);
        echo "<p>Invalid redirect target.</p>";
        exit;
    }
}

// If no redirect parameter is given
http_response_code(500);
echo "<p>Missing redirect target.</p>";
exit;

?>
