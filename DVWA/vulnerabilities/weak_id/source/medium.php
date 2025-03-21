<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$cookie_value = time();
	#setcookie("dvwaSession", $cookie_value);
	setcookie("dvwaSession", $cookie_value, [
		'expires' => time() + 3600, // 1-hour expiry
		'httponly' => true,  // Prevents JavaScript access (XSS protection)
		'secure' => true,    // Only send over HTTPS
		'samesite' => 'Strict' // Prevents CSRF
	]);
}
?>
