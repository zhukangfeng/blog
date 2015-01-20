<?php
	if (isset($_POST["register"])) {

		$user_name = $_POST["user_name"];
		$user_id = $_POST["user_id"];
		$user_mail = $_POST["user_mail"];
		$user_birthday = $_POST["user_birthday"];
		$user_password = $_POST["user_password"];
		$user_password_confirm = $_POST["user_password_confirm"];
		if (mb_strlen($user_name) < 3) {
			echo "<script type='text/javascript'> window.location.href='index.php?page=about_me.php';alert('name is too shoot, it should lengther than 3'); </script>";
		} else if (check_email($user_mail) == 0) {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=register.php';alert('mail is illegal.'); </script>";
	//		return;
		} else if (mb_strlen($user_password) < 3) {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=register.php';alert('password is too shoot, it should lengther than 3'); </script>";
		//	return;
		} else if ($user_password != $user_password_confirm) {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=register.php';alert('password and the confirm is not the same'); </script>";
		//	return;
		} else {
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$sql = "INSERT INTO " . DB_TABLE_USER . "(" . DB_USER_ID . ", " . DB_USER_NAME . ", " . DB_USER_BIRTHDAY . ", " 
					. DB_USER_REGISTER_TIME . ", " . DB_USER_LAST_LOGIN_TIME . ", " . DB_USER_MAIL . ", " . DB_USER_PASSWORD
					. ") VALUES (NULL, '" . $user_name . "', '" . $user_birthday . "', '" . date('Y-m-d H:i:s',time()) . "', CURRENT_TIMESTAMP, '" . $user_mail . "', '"
					. sha1($user_password) . "');";
			//echo $sql;

		//	exit();
			$register = $db_conn->query($sql);

			//print_r($user_infos);
			if (!$register) {
				$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_MAIL . " = '" .$user_mail . "';";
				$rs = $db_conn->query($sql);
			//	echo "$sql";
				//exit();
				if ($rs->fetch_array()) {
					echo "<script type='text/javascript'>  window.location.href='index.php?page=register.php';alert('this mail has registered, using another mail!'); </script>";
			
				} else {
					echo "<script type='text/javascript'>  window.location.href='index.php?page=register.php';alert('user registered failed!'); </script>";
				}
			} else {
				$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_MAIL . " = '" .$user_mail . "';";
				$rs = $db_conn->query($sql);
				$info = $rs->fetch_array();
				echo "<script type='text/javascript'>  window.location.href='index.php';alert('user registered succeed! your id is \"" . $info[DB_USER_ID] . "\"'); </script>";
			}
			exit();

			// INSERT INTO `blog`.`user` (`user_id`, `user_name`, `birthday`, `register_time`, `last_login_time`, `mail`, `password`) 
			// VALUES (NULL, 'test', '2012-08-03', '2014-11-11 12:14:05', CURRENT_TIMESTAMP, 'test@test.com', 'test');
		}

	}


	function check_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }
?>