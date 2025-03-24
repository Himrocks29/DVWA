<?php

// Define allowed redirect paths (whitelist)
$allowedPaths = [
    "/home.php",
    "/dashboard.php",
    "/profile.php"
];
if (array_key_exists ("redirect", $_GET) && $_GET['redirect'] != "") {
	
	if (preg_match ("/http:\/\/|https:\/\//i", $_GET['redirect'])) {
		http_response_code (500);
		?>
		<p>Absolute URLs not allowed.</p>
		<?php
		exit;
	} else {
		if (in_array($redirectUrl, $allowedPaths, true)) {
			header("Location: " . $redirectUrl, true, 302);
			exit;
	}
}

http_response_code (500);
?>
<p>Missing redirect target.</p>
<?php
exit;
?>
