<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] = 'Help' . $page[ 'title_separator' ].$page[ 'title' ];
$allowed_pages = [
    "sqli", 
    "xss", 
    "csrf", 
    "upload"
];
if (array_key_exists ("id", $_GET) &&
	array_key_exists ("security", $_GET) &&
	array_key_exists ("locale", $_GET)) {
	$id       = $_GET[ 'id' ];
	$security = $_GET[ 'security' ];
	$locale = $_GET[ 'locale' ];

	ob_start();
	if (isset($id) && in_array($id, $allowed_pages, true)) {
		$file_path = DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/{$id}/help/help.php";
	/*if ($locale == 'en') {
		eval( '?>' . file_get_contents( DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/{$id}/help/help.php" ) . '<?php ' );
	}*/ 
	else {
		eval( '?>' . file_get_contents( DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/{$id}/help/help.{$locale}.php" ) . '<?php ' );
	}
	$help = ob_get_contents();
	ob_end_clean();
} else {
	$help = "<p>Not Found</p>";
}

$page[ 'body' ] .= "
<script src='/vulnerabilities/help.js'></script>
<link rel='stylesheet' type='text/css' href='/vulnerabilities/help.css' />

<div class=\"body_padded\">
	{$help}
</div>\n";

dvwaHelpHtmlEcho( $page );

?>
