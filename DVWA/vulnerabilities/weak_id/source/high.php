<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (!isset ($_SESSION['last_session_id_high'])) {
		$_SESSION['last_session_id_high'] = 0;
	}
	$_SESSION['last_session_id_high']++;
	$cookie_value = md5($_SESSION['last_session_id_high']);
	#setcookie("dvwaSession", $cookie_value, time()+3600, "/vulnerabilities/weak_id/", $_SERVER['HTTP_HOST'], false, false);
	setcookie("dvwaSession", $cookie_value, [
		'expires' => time() + 3600, // 1-hour expiry
		'httponly' => true,  // Prevents JavaScript access (XSS protection)
		'secure' => true,    // Only send over HTTPS
		'samesite' => 'Strict' // Prevents CSRF
		$_SERVER['HTTP_HOST'] => false
	]);
}

?>
