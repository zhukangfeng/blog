<?php

$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($db_conn->connect_errno) {
	die("Unable to connect to Database: " . $db_conn->connect_error);
} else {
	//	echo "Database connected succeed!<br \>";
}
$db_conn->set_charset("utf8");

//Get the lastest 10 post.
$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " ORDER BY " . DB_POST_ID . " DESC LIMIT 10;";
//echo ($db_get_blog);
$db_value = $db_conn->query($db_get_blog);
if (!$db_value) {
	echo "table is null";
} else {
	if ($db_value->num_rows > 0) {
		//	echo "<br />num_rows > 0<br />";
		echo $row["title"];
		while ($row = $db_value->fetch_array()) {
			$blog_value[] = $row;

		}
	}
}
$db_conn->close();

?>