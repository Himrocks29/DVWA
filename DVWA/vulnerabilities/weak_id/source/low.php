<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (!isset ($_SESSION['last_session_id'])) {
		$_SESSION['last_session_id'] = 0;
	}
	$_SESSION['last_session_id']++;
	$cookie_value = $_SESSION['last_session_id'];
	#setcookie("dvwaSession", $cookie_value);
	setcookie("dvwaSession", $cookie_value, [
		'expires' => time() + 3600, // 1-hour expiry
		'httponly' => true,  // Prevents JavaScript access (XSS protection)
		'secure' => true,    // Only send over HTTPS
		'samesite' => 'Strict' // Prevents CSRF
	]);
}
?>
