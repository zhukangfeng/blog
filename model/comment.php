<?php
	//echo "model";
	if (isset($_POST['comment']) && isset($_POST['comment_textarea']) && isset($_POST['comment_id']) && isset($_POST['post_detail_url'])
		&& isset($_POST['post_id'])) {
		$father_url = $_POST['post_detail_url'];
		if ($_POST["comment_textarea"] == null) {
			echo "<script type='text/javascript'>  window.location.href='" . $father_url . "';alert('comment should not empty!'); </script>";
			exit;
		}
		$comment = $_POST['comment_textarea'];
		$comment = str_replace("'", "\'", $comment);
		// //$comment_label = $_POST['comment_label'];
		$father_comment_id = $_POST['comment_id'];
		$post_id = $_POST['post_id'];

	 // 	echo $father_url . "<br />";
		// echo $comment . "<br />";
	//	echo $comment_label . "<br />";
		//echo $father_comment_id . "<br />";

		if (isset($_COOKIE[DB_USER_ID])) {
			$comment_user_id = $_COOKIE[DB_USER_ID];
		} else {
			$comment_user_id = 0;
		}

		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($db_conn->connect_errno) {
			die("Unable to connect to Database: " . $db_conn->connect_error);
		} else {
		//	echo "Database connected succeed!<br \>";
		}
		$db_conn->set_charset("utf8");

		$sql = "INSERT INTO " . DB_TABLE_COMMENT . " VALUES (NULL, '" . $post_id . "', '" .  $father_comment_id . "', '" . $comment
				. "', '" . $comment_user_id . "', '" . date('Y-m-d H:i:s',time()) . "');";
	//	echo $sql;
//exit();
		$result = $db_conn->query($sql);
//exit();
		if (!$result) {
			echo "<script type='text/javascript'>  window.location.href='" . $father_url . "';alert('comment failed!'); </script>";
		} else {
			echo "<script type='text/javascript'>  window.location.href='" . $father_url . "'; </script>";
		}

//		exit();


	} else {
		if (isset($_POST['post_detail_url'])) {
			echo "<script type='text/javascript'>  window.location.href='" . $father_url . "'; alert('comment failed!1'); </script>";
		} else {
			echo "<script type='text/javascript'>  window.location.href='index.php'; alert('comment failed!2');</script>";
		}	
	}
?>