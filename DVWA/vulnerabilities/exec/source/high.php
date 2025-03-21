<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	#$target = trim($_REQUEST[ 'ip' ]);
	$target = trim($_POST[ 'ip' ]);

	// Set blacklist
	$substitutions = array(
		'||' => '',
		'&'  => '',
		';'  => '',
		'| ' => '',
		'-'  => '',
		'$'  => '',
		'('  => '',
		')'  => '',
		'`'  => '',
	);

	// Remove any of the characters in the array (blacklist).
	/*$target = str_replace( array_keys( $substitutions ), $substitutions, $target );

	// Determine OS and execute the ping command.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping  ' . $target );
	}
	else {
		// *nix
		$cmd = shell_exec( 'ping  -c 4 ' . $target );
	}*/
	if (!filter_var($target, FILTER_VALIDATE_IP)) {
        die("Invalid IP address.");
	if (stristr(PHP_OS, 'WIN')) {
        // Windows command
        $cmd = escapeshellcmd("ping $target");
    } else {
        // Linux/macOS command (limit to 4 packets)
        $cmd = escapeshellcmd("ping -c 4 $target");
    }

    // Execute the command safely
    $output = shell_exec($cmd);
	// Feedback for the end user
	$html .= "<pre>{$cmd}</pre>";
}

?>
