<?php
	//include_once ("constant/constant.php");
	include_once (dirname(__FILE__) . '/../constant/constant.php');

	if (isset($_POST['submit'])) {
		//echo "string";
		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($db_conn->connect_errno) {
			die("Unable to connect to Database: " . $db_conn->connect_error);
		} else {
		//	echo "Database connected succeed!<br \>";
		}
		$db_conn->set_charset("utf8");

		if (isset($_COOKIE[DB_USER_ID])) {
			 $sql = "UPDATE " . DB_TABLE_POST . " SET " . DB_POST_TITLE . " = '" . str_replace("'", "\'", $_POST['title']) . "', " . DB_POST_PLACE . " = '" 
			 		. str_replace("'", "\'", $_POST['place']) . "', " . DB_POST_POST . " = '" . str_replace("'", "\'", $_POST['post']). "', " . DB_POST_MODIFY_TIME . " = '" . date('Y-m-d H:i:s',time())
			 		. "' WHERE " . DB_POST_ID . " = '" . $_POST['id'] . "' && " . DB_POST_USER_ID . " = '" . $_COOKIE[DB_USER_ID] . "';";

		//	 echo($sql);
		//	exit();
			// $sql = "UPDATE " . DB_TABLE_USER . " SET " . DB_USER_NAME . " = '" . $user_name . "', " .DB_USER_MAIL . " = '" . $user_mail
			// 	. "', " . DB_USER_BIRTHDAY . " = '" . $user_birthday . "', ". DB_USER_PASSWORD . " = '" . sha1($user_password) . "' WHERE " . DB_USER_ID . " = '" . $user_id . "';";
			$result = $db_conn->query($sql);
		//	echo $db_conn->affected_rows;
			echo "<script type='text/javascript'>  window.location.href='../index.php?page=post_detail.php&post_id=" . $_POST['id'] . "'; </script>";
		
		//	exit();
		} else {
			echo "<script type='text/javascript'>  window.location.href='../index.php?page=login.php';alert('you hava not logined, you can not modify the post. please login!'); </script>";
		}





	} else {
		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($db_conn->connect_errno) {
			die("Unable to connect to Database: " . $db_conn->connect_error);
		} else {
		//	echo "Database connected succeed!<br \>";
		}
		$db_conn->set_charset("utf8");
		$db_get_blog = "SELECT * FROM " . DB_TABLE_POST . " WHERE " . DB_POST_ID . " = " . $_GET['post_id'] . ";";
		// echo $_GET['id'] . "232<br />" . $db_get_blog;
		// echo "<br />" . $db_get_blog . "<br />";
		$db_value = $db_conn->query($db_get_blog);
		if (!$db_value) {
			echo "sorry , there is not this post.";
		} else {
			if ($db_value->num_rows > 0) {
			//	echo $db_value->num_rows;
				//echo $row["post_title"];
				while($row = $db_value->fetch_array() ){                        //循环输出结果集中的记录
					//print_r($row);
				//	echo "id1111+++++" . $row[DB_USER_ID];
					$row[POST_AUTHOR] = get_user_name($row[DB_USER_ID]);
				//	echo "string";
					$row[DB_POST_POST] = $row[DB_POST_POST];
					$row[DB_POST_PLACE] = $row[DB_POST_PLACE];

					$value = $row;
				//	print_r($row);
	            }
			}
		}



		$comm_sql = "SELECT * FROM " . DB_TABLE_COMMENT . " WHERE " . DB_COMMENT_POST_ID . " = " . $_GET['post_id'] . " ORDER BY " . DB_COMMENT_TIME . " DESC;";
		//echo "$comm_sql";
		$comments = $db_conn->query($comm_sql);
	//	print_r($comments);
		if (!$db_value) {
			;
		} else {
			while(($row = $comments->fetch_array())){                        //comments;
				//print_r($row);
			//	echo "id1111+++++" . $row[DB_USER_ID];
			//	print_r($row);
				//echo ;
				if ($row[DB_COMMENT_USER_ID] == 0) {
					$row[COMMENT_AUTHOR] = GUEST;
				} else {
					$row[COMMENT_AUTHOR] = get_user_name($row[DB_COMMENT_USER_ID]);
				}
				if ($row[DB_COMMENT_FATHER_COMMENT_ID] == 0) {
					$row[FATHER_COMMENT_AUTHOR] = CONSTANT_POST;
				} else {
					$row[FATHER_COMMENT_AUTHOR] = get_father_comment_name($row[DB_COMMENT_FATHER_COMMENT_ID]);
				}
				
			//	echo "string";
				$comment[] = $row;
				//print_r($row);
            }
		//	print_r($comment);
		}



		$db_conn->close();


		/**
		 * use user_id get user_name from table user;
		 **/

			//print_r($name->fetch_array())
			//return $name->fetch_array()[DB_USER_NAME];
		
	}

	function get_user_name($id) {
	//	echo "dsafsdlkf";
		$db_get_user_name = "SELECT " . DB_USER_NAME . " FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID
		. " = " . $id . ";";
	//	echo $db_get_user_name;
		//exit;
		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($db_conn->connect_errno) {
			die("Unable to connect to Database: " . $db_conn->connect_error);
		} 
		$db_conn->set_charset("utf8");
		$user_value = $db_conn->query($db_get_user_name);
	//	print_r($user_value);
		if ($user_value) {
			$temp = $user_value->fetch_array();
			return $temp[DB_USER_NAME];
		} else {
			return GUEST;
		}
	//	$db_conn.close();
	}

	function get_father_comment_name($id) {
		$sql = "SELECT " . DB_COMMENT_USER_ID . " FROM " . DB_TABLE_COMMENT . " WHERE " . DB_COMMENT_ID 
				. " = " . $id . ";";
	//	echo $sql;
		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($db_conn->connect_errno) {
			die("Unable to connect to Database: " . $db_conn->connect_error);
		} 
		$db_conn->set_charset("utf8");
		$user_id = $db_conn->query($sql);


		if ($user_id) {
			$value= $user_id->fetch_array();
			$id = $value[DB_COMMENT_USER_ID];
			if ($id == 0) {
				return CONSTANT_POST;
			}
			$db_get_user_name = "SELECT " . DB_USER_NAME . " FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID
			. " = " . $id . ";";
		//	echo $db_get_user_name;
			//exit;
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($db_conn->connect_errno) {
				die("Unable to connect to Database: " . $db_conn->connect_error);
			} 
			$db_conn->set_charset("utf8");
			$user_value = $db_conn->query($db_get_user_name);
		//	print_r($user_value);
			if ($user_value) {
				$temp = $user_value->fetch_array();
				return $temp[DB_USER_NAME];
			} else {
				return GUEST;
			}
			//retrun get_user_name(1);
		} else {
			return GUEST;
		}

	}

?>