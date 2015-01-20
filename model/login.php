<?php
ob_start();
include_once (dirname(__FILE__) . '/../constant/constant.php');
print_r($_COOKIE[DB_USER_NAME]);
//echo "1111";
if (isset($_POST["login"])) {
	//echo "2222";

	$password = $_POST['password'];
	//$_POST["login"] = null;
	$user_id = $_POST['user_id'];
	$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($_POST['login'] == 'login by id') {
		
		$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $user_id . " && "
				. DB_USER_PASSWORD . " = '" . sha1($password) . "';";
		//echo($sql);
		$user_infos = $db_conn->query($sql);
		//echo "$user_infos->num_rows";
		if ($user_infos->num_rows > 0) {
			$user_info = $user_infos->fetch_array();
			//session_start();
			//echo ($user_info[DB_USER_NAME]);

			setcookie(DB_USER_NAME, $user_info[DB_USER_NAME], time() + 3600, "");
			setcookie(DB_USER_ID, $user_info[DB_USER_ID], time() + 3600, "");
			setcookie(DB_USER_MAIL, $user_info[DB_USER_MAIL], time() + 3600, "");
			setcookie(DB_USER_PASSWORD, $user_info[DB_USER_PASSWORD], time() + 3600, "");
			setcookie(DB_USER_BIRTHDAY, $user_info[DB_USER_BIRTHDAY], time() + 3600, "");
			setcookie(DB_USER_REGISTER_TIME, $user_info[DB_USER_REGISTER_TIME], time() + 3600, "");
			setcookie(DB_USER_LAST_LOGIN_TIME, $user_info[DB_USER_LAST_LOGIN_TIME], time() + 3600, "");
			echo ($_COOKIE[DB_USER_NAME]);

			$sql = "UPDATE " . DB_TABLE_USER . " SET " . DB_USER_LAST_LOGIN_TIME . " = CURRENT_TIMESTAMP WHERE " 
					. DB_USER_ID . " = " . $user_info[DB_USER_ID] . ";";
			$db_conn->query($sql);
			//echo "string";
			//echo($_COOKIE[DB_USER_NAME]);

			echo "<script type='text/javascript'>  window.location.href='index.php'; </script>";




		} else {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=login.php';alert('user id or password is error, please try again!'); </script>";
		}

	
	
	} else {
		//echo "111";

		$mail = $_POST['mail'];
		if (!check_email($mail)) {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=login.php';alert('user mail is ilegal, please try again!'); </script>";
			exit();
		}
		$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_MAIL . " = '" . $mail . "' && "
				. DB_USER_PASSWORD . " = '" . sha1($password) . "';";
		//echo($sql);
		$user_infos = $db_conn->query($sql);
		//echo "$user_infos->num_rows";
		if ($user_infos->num_rows > 0) {
			$user_info = $user_infos->fetch_array();
			//session_start();
			//echo ($user_info[DB_USER_NAME]);

			setcookie(DB_USER_NAME, $user_info[DB_USER_NAME], time() + 3600, "");
			setcookie(DB_USER_ID, $user_info[DB_USER_ID], time() + 3600, "");
			setcookie(DB_USER_MAIL, $user_info[DB_USER_MAIL], time() + 3600, "");
			setcookie(DB_USER_PASSWORD, $user_info[DB_USER_PASSWORD], time() + 3600, "");
			setcookie(DB_USER_BIRTHDAY, $user_info[DB_USER_BIRTHDAY], time() + 3600, "");
			setcookie(DB_USER_REGISTER_TIME, $user_info[DB_USER_REGISTER_TIME], time() + 3600, "");
			setcookie(DB_USER_LAST_LOGIN_TIME, $user_info[DB_USER_LAST_LOGIN_TIME], time() + 3600, "");
			echo ($_COOKIE[DB_USER_NAME]);

			$sql = "UPDATE " . DB_TABLE_USER . " SET " . DB_USER_LAST_LOGIN_TIME . " = CURRENT_TIMESTAMP WHERE " 
					. DB_USER_ID . " = " . $user_info[DB_USER_ID] . ";";
			$db_conn->query($sql);
			//echo "string";
			//echo($_COOKIE[DB_USER_NAME]);

			echo "<script type='text/javascript'>  window.location.href='index.php'; </script>";




		} else {
			echo "<script type='text/javascript'>  window.location.href='index.php?page=login.php';alert('user mail or password is error, please try again!'); </script>";
		}

		
	}

}

function check_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }

?>