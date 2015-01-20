<?php
	if (isset($_POST["submit"]) && isset($_POST['title']) && isset($_POST['place']) && isset($_POST['post'])) {
		if (isset($_COOKIE[DB_USER_ID])) {
			# code...
			$db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$db_conn->set_charset("utf8");

			$sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $_COOKIE[DB_USER_ID] . " && "
			      . DB_USER_PASSWORD . " = '" . $_COOKIE[DB_USER_PASSWORD] . "';";
			  //echo($sql);
			$user_infos = $db_conn->query($sql);
			if ($user_infos->num_rows > 0) {
				$t = date('Y-m-d H:i:s',time());
 			
  				$sql = "INSERT INTO " . DB_TABLE_POST . " VALUES (NULL, '" . str_replace("'", "\'", $_POST['title']) . "', '"
  						. $t . "', '" . $t . "', '" . $_COOKIE[DB_USER_ID] . "', '" . str_replace("'", "\'", $_POST['place']) 
  						. "', '" . str_replace("'", "\'", $_POST['post']) . "');";
  						//echo $sql;
			 	$info = $db_conn->query($sql);
			 //	echo $info;
			 	if ($info) {
			
			 		$sql = "SELECT " . DB_POST_ID . " FROM " . DB_TABLE_POST . " WHERE " . DB_POST_TIME . " = '" . $t . "' && "
			 				. DB_POST_USER_ID . " = '" . $_COOKIE[DB_USER_ID] . "';";
			 		///echo $sql;
			 		$info = $db_conn->query($sql);
			 		//print_r($info);
			 		$post_id = $info->fetch_array();
			 		//echo $post_id[DB_POST_ID];
			 		echo "<script type='text/javascript'>window.location.href='index.php?page=post_detail.php&post_id=" . $post_id[DB_POST_ID] . "';</script>";
			 		//echo "fsjafklsjdfsjdf";
			 	} else {
			 		echo "<script type='text/javascript'>alert('sorry post failed!'); </script>";
			 	}
			// exit();

  			} else {
  	 			echo "<script type='text/javascript'> window.location.href='index.php?page=login.php';alert('pleace login first!'); </script>";
			//	exit();
  			}
		}

	}


	function check_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }
?>