<pre>
<?php
	include_once (dirname(__FILE__) . '/../constant/constant.php');
	
	/**
	 * test 
	 **/
	//$_SESSION['id'] = 1;
	if (isset($_COOKIE[DB_USER_ID])) {
		//include_once "db_conn.php";
		$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $_COOKIE[DB_USER_ID] . " && "
			. DB_USER_PASSWORD . " = '" . $_COOKIE[DB_USER_PASSWORD] . "';";
		//echo "$sql";
		//print_r($db_conn);
		$user_infos = $db_conn->query($sql);
		//print_r($user_infos);
		if (!$user_infos) {
			setcookie(DB_USER_NAME, false, time() - 3600, "");
			setcookie(DB_USER_ID, false, time() - 3600, "");
			setcookie(DB_USER_MAIL, false, time() - 3600, "");
			setcookie(DB_USER_PASSWORD, false, time() - 3600, "");
			setcookie(DB_USER_BIRTHDAY, false, time() - 3600, "");
			setcookie(DB_USER_REGISTER_TIME, false, time() - 3600, "");
			setcookie(DB_USER_LAST_LOGIN_TIME, false, time() - 3600, "");
			
		} else {
			if ($user_infos->num_rows > 0) {
				$user_info = $user_infos->fetch_array();
			//	print_r($user_info);
			}
		}
	} else {

		header("location:" . "index.php?page=register.php");
			
		echo "not login";

	}





?>
</pre>