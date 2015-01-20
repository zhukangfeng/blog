<pre><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="center" valign="middle">
	<table  width="80%" border="1" >
<?php
//				echo "string111111111";

foreach ($blog_value as $key => $value) {
//	print_r($value);
	echo "<tr><td valign=\"middle\" align=\"middle\" colspan=\"4\"><li><a href=\"index.php?page=post_detail.php&post_id=" . $value[DB_POST_ID] . "\">". $value[DB_POST_TITLE] . "</a></li></td></tr>";
	echo "<tr><td valign=\"middle\" align=\"middle\">" . DB_POST_ID . ": " . $value[DB_POST_ID] . "</td>";
	echo "<td valign=\"middle\" align=\"middle\">" . DB_USER_NAME . ": " . $value[DB_USER_NAME] . "</td>";
	echo "<td valign=\"middle\" align=\"middle\">" . DB_POST_PLACE . ": " . $value[DB_POST_PLACE] . "</td>";
	echo "<td valign=\"middle\" align=\"middle\">" . DB_POST_TIME . ": " . $value[DB_POST_TIME] . "</td></tr>";
	echo "<tr><td colspan=\"4\">" . $value[DB_POST_POST] . "</td></tr>";
	echo "<tr ><td colspan=\"4\"></td></tr>";
}
?>
		</table>
	</td></tr>
</table>
</pre>