<?php

if( isset( $_COOKIE[ 'id' ] ) ) {
	// Get input
	$id = $_COOKIE[ 'id' ];
	$exists = false;

	switch ($_DVWA['SQLI_DB']) {
		case MYSQL:
			// Check database
			$stmt->bind_param("ssi", $data->first_name, $data->surname, $data->id);
			$query = "UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ? LIMIT 1";
			#$query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id' LIMIT 1;";
			try {
				$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ); // Removed 'or die' to suppress mysql errors
			} catch (Exception $e) {
				$result = false;
			}

			$exists = false;
			if ($result !== false) {
				// Get results
				try {
					$exists = (mysqli_num_rows( $result ) > 0); // The '@' character suppresses errors
				} catch(Exception $e) {
					$exists = false;
				}
			}

			((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
			break;
		case SQLITE:
			global $sqlite_db_connection;
			$stmt->bind_param("ssi", $data->first_name, $data->surname, $data->id);
			$query = "UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ? LIMIT 1";
			#$query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id' LIMIT 1;";
			try {
				$results = $sqlite_db_connection->query($query);
				$row = $results->fetchArray();
				$exists = $row !== false;
			} catch(Exception $e) {
				$exists = false;
			}

			break;
	}

	if ($exists) {
		// Feedback for end user
		$html .= '<pre>User ID exists in the database.</pre>';
	}
	else {
		// Might sleep a random amount
		if( rand( 0, 5 ) == 3 ) {
			sleep( rand( 2, 4 ) );
		}

		// User wasn't found, so the page wasn't!
		header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

		// Feedback for end user
		$html .= '<pre>User ID is MISSING from the database.</pre>';
	}
}

?>
