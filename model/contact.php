<?php

	if (isset($_POST['context'])) {
		$sender = $_POST['sender'];
		$context = $_POST['context'];
		$receiver = $_POST['receiver'];   //
		$context = wordwrap($context, 70);




		if (!check_email($sender) || !check_email($receiver)) {
			$_POST['context'] = null;
			
			echo "<script type='text/javascript'>  window.location.href='index.php?page=contact.php';alert('mail address is illegal!'); </script>";	
		} else if (mail($receiver, "contact", $context, $sender)) {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=contact.php';alert('mail sended succeed!'); </script>";
		} else {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=contact.php';alert('mail sended failed!'); </script>";
		}
		 
	} else {
		if (isset($_GET['receiver_id'])) {
			$receiver_id = $_GET['receiver_id'];
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($db_conn->connect_errno) {
				die("Unable to connect to Database: " . $db_conn->connect_error);
			} else {
				//echo "Database connected succeed!<br \>";
			}
			$db_conn->set_charset("utf8");
			$sql = "SELECT " . DB_USER_MAIL . " FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $receiver_id . ";";
			//echo($sql);
			$user_infos = $db_conn->query($sql);
			//echo "$user_infos->num_rows";
		//	print_r($user_infos);
			if ($user_infos->num_rows > 0) {
				$user_info = $user_infos->fetch_array();
				$receiver = $user_info[DB_USER_MAIL];
			}
		}
	}

	function check_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }
?>