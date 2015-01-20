
<?php
//echo "XXXXXXXXXXXXXXXXXXXXXXX";
//print_r($blog_value);
foreach ($blog_value as $key => $value) {
// 	echo "<tr><td valign=\"middle\"> <li><a href=\"index.php?page=post_detail.php&post_id=" . $value[DB_POST_ID] . "\">" . $value[DB_POST_TITLE] . "</a></li></td></tr>";
// 	//	<li><a href="index.php?page=contact.php">Contact</a></li>
// //	echo "????<br />";
	// echo "<tr><td>" . mb_substr($value[DB_POST_POST], 0, 50, "utf-8") . "</td></tr>";
//	echo "!!!!!<br />";

	$jsp = "<div class='blog'><p>";
	$jsp .= "<h2 class='blog_title'><li><a href=\"index.php?page=post_detail.php&post_id=";
	$jsp .= $value[DB_POST_ID] . "\">";
	$jsp .= $value[DB_POST_TITLE] . "</a></li><h2>";

	$jsp .= "<h3 class='blog_value'>" . mb_substr($value[DB_POST_POST], 0, 50, "utf-8") . "..." . "</h3>";
	$jsp .= "</p></div>";

	echo $jsp;





}
?>
