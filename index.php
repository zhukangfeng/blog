<?php
ob_start();
include_once(dirname(__FILE__) . '/constant/env_properties.php');
include_once(dirname(__FILE__) . '/constant/constant.php');
//session_start();
//$_SESSION[DB_USER_ID] = 1;
?>
<!DOCTYPE html>
<html lang="en">
     <head>
               <meta charset="UTF-8"/>
               <title> <?php if (isset($_COOKIE[DB_USER_NAME])) { echo $_COOKIE[DB_USER_NAME] . 'の';} ?>Blog</title>
               <link rel="icon" type="image/jpg" href="images/background.jpg" />
               <link rel="stylesheet" type="text/css" href="css/index.css"/>

     </head>
     <body style="background-image:iamges/background.jpg">
       <header  href = "images/background.jpg">
           <div id="Main title">
           <h1 class="title"><label id="blog_title"><?php if (isset($_COOKIE[DB_USER_NAME])) { echo $_COOKIE[DB_USER_NAME] . 'の';} ?>Blog</label></h1>
           </div>
                  <div class="content">

                     			 <nav>
                     			      <ul>
                     			      	  <li><a href="index.php">Main</a></li>
                                    <li><a href="index.php?page=blog.php&pages=1&page_num=10">Blog</a>

<?php
//$_SESSION[DB_USER_ID] = 2;
// print_r($_COOKIE);
// print_r($_COOKIE["user_id"]);
//echo DB_USER_ID;
if (isset($_COOKIE[DB_USER_ID])) {
  //print_r($_COOKIE);
  $db_conn = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM " . DB_TABLE_USER . " WHERE " . DB_USER_ID . " = " . $_COOKIE[DB_USER_ID] . " && "
      . DB_USER_PASSWORD . " = '" . $_COOKIE[DB_USER_PASSWORD] . "';";
  //echo($sql);
  $user_infos = $db_conn->query($sql);



  if ($user_infos->num_rows > 0) {
      echo "<li><a href='index.php?page=new_post.php'>New post</a></li>";
      echo "<li><a href='index.php?page=blog.php&author_id=" . $_COOKIE[DB_USER_ID] . "'>My blog</a></li>";
?>
                        <li><a href="index.php?page=about_me.php">About me</a></li>
                        <li><a href="index.php?page=contact.php">Contact</a></li>



<?php
      echo "<li><a href='index.php?page=logout.php'>Logout</a></li>"; 
  } else {
    //echo "111+111";
      //delete the unusing cookie;
      setcookie(DB_USER_NAME, false, time() - 3600, "");
      setcookie(DB_USER_ID, false, time() - 3600, "");
      setcookie(DB_USER_MAIL, false, time() - 3600, "");
      setcookie(DB_USER_PASSWORD, false, time() - 3600, "");
      setcookie(DB_USER_BIRTHDAY, false, time() - 3600, "");
      setcookie(DB_USER_REGISTER_TIME, false, time() - 3600, "");
      setcookie(DB_USER_LAST_LOGIN_TIME, false, time() - 3600, "");
     $delcookie = "function delcookie(name){   
          var exp = new Date();    
          exp.setTime(exp.getTime() - 1);   
           var cval=getCookie(name);   
          if(cval!=null) document.cookie= name + '='+cval+';expires='+exp.toGMTString();";

    $jsp = "<script type='text/javascript'>" . $delcookie . "delcookie(" .  $_COOKIE[DB_USER_ID] 
          . ");</script>";
    //echo $jsp;
    echo "<li><a href='index.php?page=login.php'>Login</a></li>";
    ob_end_flush();
  
  }   
 // echo "<a href='index.php?page=logout.php'>Logout</a>" . $_COOKIE[DB_USER_NAME] . " Welcome you!";
?>
                        

<?php
} else {
  echo "<li><a href='index.php?page=login.php'>Login</a></li>";
  echo "<li><a href='index.php?page=register.php'>Register</a></li>";
}
?>
                        
<?php
 
?>
                         </li>
         			      </ul>
         			</nav>
            </div>
       </header>
      </body>

<?php
//On inclut le contrôleur s'il existe et s'il est spécifié

if (!empty($_GET['page'])) {
	//echo $_GET['page'];
	include 'controller/' . $_GET['page'] . '';
} else {
	//	echo "form index++++++++";
	include 'controller/index.php';
}

//include 'view/aside.php';
?>
<footer>
    <div class="copyright">
      <adress>@shu All right reserved</adress>
    </div>
     
</footer>
  </body>
</html>

<?php

?>

