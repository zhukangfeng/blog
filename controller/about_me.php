
<?php
	ob_start();
//	echo "<br />controller<br />";
	include(dirname(__FILE__).'/../constant/constant.php');
	//session_start();
		//	return;
	if ($_POST[DB_USER_NAME] == true) {
	//	echo "<script type=\"text/javascript\"> alert('abc'); </script>";
		$user_name = $_POST[DB_USER_NAME];
		$user_id = $_POST[DB_USER_ID];
		$user_mail = $_POST[DB_USER_MAIL];
		$user_birthday = $_POST[DB_USER_BIRTHDAY];
		$user_password = $_POST[DB_USER_PASSWORD];
		$user_password_confirm = $_POST[PASSWORD_CONFIRM];

		$_POST[DB_USER_NAME] = null;
			

		if (mb_strlen($user_name) < 3) {
			echo "<script type='text/javascript'> window.location.href='../index.php?page=about_me.php';alert('name is too shoot, it should lengther than 3'); </script>";
			//$url = "index.php?page=about_me.php";
			//header('location:' . $url);	
			//echo "<script type='text/javascript'> alert('name is too shoot, it should lengther than 3'); </script>";
			
		//	return;
		} else if (check_email($user_mail) == 0) {
			echo "<script type='text/javascript'>  window.location.href='../index.php?page=about_me.php';alert('mail is illegal.'); </script>";
	//		return;
		} else if (mb_strlen($user_password) <= 3) {
			echo "<script type='text/javascript'>  window.location.href='../index.php?page=about_me.php';alert('password is too shoot, it should lengther than 3'); </script>";
		//	return;
		} else if ($user_password != $user_password_confirm) {
			echo "<script type='text/javascript'>  window.location.href='../index.php?page=about_me.php';alert('password and the confirm is not the same'); </script>";
		//	return;
		} else {
			$_POST[DB_USER_NAME] = false;
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$sql = "UPDATE " . DB_TABLE_USER . " SET " . DB_USER_NAME . " = '" . $user_name . "', " .DB_USER_MAIL . " = '" . $user_mail
				. "', " . DB_USER_BIRTHDAY . " = '" . $user_birthday . "', ". DB_USER_PASSWORD . " = '" . sha1($user_password) . "' WHERE " . DB_USER_ID . " = '" . $user_id . "';";
			//echo "$sql";
			//exit();
			//print_r($db_conn);
			//echo "<script type='text/javascript'>alert('" . sha1($user_password) . "')";
			// $_COOKIE[DB_USER_NAME] = $user_name;
			// $_COOKIE[DB_USER_MAIL] = $user_mail;
			// $_COOKIE[DB_USER_PASSWORD] = sha1($user_password);
			// setcookie(DB_USER_NAME, $user_name, time() + 3600, "");
   //  		setcookie(DB_USER_MAIL, $user_mail, time() + 3600, "");
   //    		setcookie(DB_USER_PASSWORD, sha1($user_password), time() + 3600, "");
      		//ob_end_flush();
			$user_infos = $db_conn->query($sql);

			//print_r($user_infos);
			if (!$user_infos) {
				echo "<script type='text/javascript'>  window.location.href='../index.php?page=about_me.php';alert('user information modified failed!'); </script>";
			} else {
				$js_func = "function cookie_modify(name){   
						        var exp = new Date();    
						        exp.setTime(exp.getTime() ＋ 36000);   
						        var cval=getCookie(name);   
						        if(cval!=null) document.cookie= name + '='+cval+';expires='+exp.toGMTString();
			        		}";

			    $js_name = "<script type='text/javascript'>" . $js_func . "cookie_modify(" .  $_COOKIE[DB_USER_NAME] 
 			         . ");</script>";
				//echo $js_func . "<br />" . $js_name;
				echo "<script type='text/javascript'>  window.location.href='../index.php?page=login.php';alert('user information modified succeed!'); </script>";
			}
		}
		//echo "<script type='text/javascript'> alert('" . $user_name . "'); </script>";




		



	//	$url = "index.php?page=about_me.php";
	//	header('location:' . $url);
	} else {
		include(dirname(__FILE__).'/../model/about_me.php');
		include(dirname(__FILE__).'/../view/about_me.php');
		//$_SESSION['submit'] = true;
	}

	function check_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }
?>
