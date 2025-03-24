<?php
/*$host = "192.168.0.7";
$username = "dvwa";
$password = "password";*/

/*Fix Start*/
require_once 'config.php';
$config = require 'config.php';
$username = $config['username'];
$password = $config['password'];
/*Fix END*/

mssql_connect($host, $username, $password);
mssql_select_db($database);

$query ="SELECT * FROM users";
$result =mssql_query($query);
while ( $record = mssql_fetch_array($result) ) {
	echo $record["first_name"] .", ". $record["password"] ."<br />";
}
?>
