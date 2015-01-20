<pre>
<?php
	$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($db_conn->connect_errno) {
		die("Unable to connect to Database: " . $db_conn->connect_error);
	} else {
		//echo "Database connected succeed!<br \>";
	}
	$db_conn->set_charset("utf8");

	if (isset($_POST['delete_post_id'])) {
		

		 if (isset($_COOKIE[DB_USER_ID])) {
		  //print_r($_COOKIE);
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $_COOKIE[DB_USER_ID] . " && "
			      . DB_USER_PASSWORD . " = '" . $_COOKIE[DB_USER_PASSWORD] . "';";
			  //echo($sql);
			$user_infos = $db_conn->query($sql);
			//print_r($user_infos);

			if ($user_infos->num_rows > 0) {
				$sql = "DELETE FROM " . DB_TABLE_POST . " WHERE " . DB_POST_ID . " = " . $_POST['delete_post_id'] 
					. " && " . DB_POST_USER_ID . " = " . $_COOKIE[DB_USER_ID] . ";";
				//echo $sql;

				$db_conn->query($sql);

				$sql = "DELETE FROM " . DB_TABLE_COMMENT . " WHERE " . DB_COMMENT_POST_ID . " = " . $_POST['delete_post_id'] . ";";
				

				$db_conn->query($sql);

				
			}

		 }
	}
	$pages = intval($_GET['pages']);
	$page_num = intval($_GET['page_num']);
	if ($pages > 0) {
		$pages = $pages - 1;
	} else {
		$pages = 0;
	}
	if ($page_num <= 0) {
		$page_num = 10;
	}
	$pages = $pages * $page_num;
		
	if (isset($_GET['author_id']) && isset($_COOKIE[DB_USER_ID])) {
		// $db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " WHERE " . DB_POST_USER_ID . " = " . $_GET['author_id'] . " ORDER BY " . DB_POST_ID . " DESC;";
		
		$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " WHERE " . DB_POST_USER_ID . " = " . $_GET['author_id'] . " ORDER BY " . DB_POST_ID . " DESC LIMIT ";
		$db_get_blog .= $pages . ", " . $page_num . ";";
	} else {
		//$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " ORDER BY " . DB_POST_ID . " DESC;";
		//echo $page . "abc" . $page_num;
		$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " ORDER BY " . DB_POST_ID . " DESC LIMIT ";
		$db_get_blog .= $pages . ", " . $page_num . ";";
	}


	//echo $db_get_blog;
	$db_value = $db_conn->query($db_get_blog);
	if (!$db_value) {
		echo "table is null";
	} else {
		if ($db_value->num_rows > 0) {
			while ($row = $db_value->fetch_array()) {//循环输出结果集中的记录

				//use user_id to get user_name from table user;
				$row[DB_USER_NAME] = get_user_name($row[DB_USER_ID]);
				$blog_value[] = $row;

			}
		} else {
			echo "<div style='text-align:center;margin:0 auto;'><h2>the page number and the list number is too lager </h2></div>";
		}
	}




	$db_conn->close();

	function get_user_name($id) {
		$db_get_user_name = "SELECT " . DB_USER_NAME . " FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID
		. " = " . $id . ";";
		global $db_conn;
		$user_value = $db_conn->query($db_get_user_name);
		if ($user_value) {
			$temp = $user_value->fetch_array();
			return $temp[DB_USER_NAME];
		} else {
			return GUEST;
		}
		//print_r($name->fetch_array())
		//return $name->fetch_array()[DB_USER_NAME];
	}

	// foreach (blog_value as $key => $value) {
	// 	# code...
	// 	echo "<br />" . $value["title"] . "<br />";
	// 	echo "<br />" . $value["id"] . "<br />";
	// }

	//print_r($db_value);

	/*
	echo "<br />+----------------2---model-----------+<br />";

	function get_blog_detail($desc) {
	echo "<br /> from fucntion get_blog_detail()<br />";
	//	db_value = $db_conn->mysqli_query(DB_OP_GET_BLOG_DESC);
	/*
	if (is_null($desc) || $desc) {
	echo "+----------------2--------------+";
	db_value = $db_conn->mysqli_execute(DB_OP_GET_BLOG_DESC);
	$db_blog_detail = new array();

	for ($i = 0; $i < $db_value->num_rows; $i++) {
	$db_blog_detail[i] = $db_value->fetch_array();
	}
	echo "+----------------2--------------+";
	return $db_blog_detail;

	} else {
	db_value = $db_conn->mysqli_execute(DB_OP_GET_BLOG);
	$db_blog_detail = new array();

	for ($i = 0; $i < $db_value->num_rows; $i++) {
	$db_blog_detail[i] = $db_value->fetch_array();
	}
	return $db_blog_detail;
	}




	}*/

?>
</pre>