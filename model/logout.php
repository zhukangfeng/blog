<?php
	//unset($_COOKIE);
	ob_start();
	include_once(dirname(__FILE__) . '/../constant/constant.php');

	//echo DB_USER_ID;
	//rint_r($_COOKIE);
	if (isset($_COOKIE[DB_USER_ID])) {
		//echo "2";
		echo $_POST["submit"];
		if (isset($_POST["submit"]) && $_POST["submit"] == "logout") {
			//echo $_POST["submit"];
			//echo "3";
			setcookie(DB_USER_NAME, false, time() - 3600, "");
			setcookie(DB_USER_ID, false, time() - 3600, "");
			setcookie(DB_USER_MAIL, false, time() - 3600, "");
			setcookie(DB_USER_PASSWORD, false, time() - 3600, "");
			setcookie(DB_USER_BIRTHDAY, false, time() - 3600, "");
			setcookie(DB_USER_REGISTER_TIME, false, time() - 3600, "");
			setcookie(DB_USER_LAST_LOGIN_TIME, false, time() - 3600, "");
			unset($_COOKIE);
			$_COOKIE = null;
			//setcookie(DB_USER_ID, '', time() - 1);
			//echo "==========";
			//print_r($_COOKIE);
			header("location:" . "../index.php");
			ob_end_flush();

		} else if ($_POST["submit"] == "cancel") {
			echo "4";
			header("location:" . "../index.php");
			ob_end_flush();

		}
	} else {
		echo isset($_SESSION[DB_USER_ID]) . "abc<br />";
		header("location:" . "../index.php");
		ob_end_flush();

	}
ob_end_flush();

?>