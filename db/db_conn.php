<?php
	$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($db_conn->connect_errno) {
		die("Unable to connect to Database: " . $db_conn->connect_error);
	} else {
	//	echo "Database connected succeed!<br \>";
	}
	$db_conn->set_charset("utf8");
?>