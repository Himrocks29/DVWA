<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	$target = $_REQUEST[ 'ip' ];

	// Determine OS and execute the ping command.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		#$cmd = shell_exec( 'ping  ' . $target );
		$cmd = escapeshellcmd("ping $target");
	}
	else {
		// *nix
		$cmd = escapeshellcmd("ping  -c 4 $target");
	}

	// Feedback for the end user
	$html .= "<pre>{$cmd}</pre>";
}

?>
