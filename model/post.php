<pre>
<?php


	
//	echo "aaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbb";
	
	$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($db_conn->connect_errno) {
		die("Unable to connect to Database: " . $db_conn->connect_error);
	} else {
	//	echo "Database connected succeed!<br \>";
	}
	$db_conn->set_charset("utf8");
	$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " WHERE " . DB_POST_ID . " = " . $_GET['id'] . ";";
	//echo $_GET['id'] . "<br />" . $db_get_blog;
	//echo "<br />" . $db_get_blog . "<br />";
	$db_value = $db_conn->query($db_get_blog);
	if (!$db_value) {
		echo "table is null";
	} else {
		if ($db_value->num_rows > 0) {
		//	echo "<br />num_rows > 0<br />";
	//		echo $row["title"];
			while($row = $db_value->fetch_array() ){                        //循环输出结果集中的记录
				//use user_id to get user_name from table user;
				$row[DB_USER_NAME] = get_user_name($row[DB_USER_ID]);
			
				$blog_value[] = $row;
		//		print_r($blog_value);
	//			echo "string";
		//		print_r($blog_value);

            }
		}
	}

	$db_conn->close();


	/**
	 * use user_id get user_name from table user;
	 **/
	function get_user_name($id) {
		$db_get_user_name = "SELECT " . DB_USER_NAME . " FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID
		. " = " . $id . ";";
		//	echo $db_get_user_name;
		global $db_conn;
		$user_value = $db_conn->query($db_get_user_name);
		if ($user_value) {
			return $user_value->fetch_array()[DB_USER_NAME];
		} else {
			return GUEST;
		}
		//print_r($name->fetch_array())
		//return $name->fetch_array()[DB_USER_NAME];
	}

?>
</pre>