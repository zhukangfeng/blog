<div class="right left data_table">
<div class="page_choose">
	<a href="javascript:void(0)" onclick="prev_func()">Prev</a>
	<label>Present Page: </label><label><?php if (isset($_GET['pages']) && intval($_GET['pages']) > 0) echo intval($_GET['pages']); else echo "1"; ?></label>
	<a href="javascript:void(0)" onclick="next_func()">Next</a>
	<input name='pages' id='pages' type="number" min='1' style="text-align: center" placeholder="page number" oninput='replaceNotNumber(this)'>
	<a href="javascript:void(0)" onclick="jump_func()">Jump</a>
	<input name='page_num' id='page_num' type="number" min='1' style="text-align: center" value="<?php  echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 10; ?>" placeholder="list number" oninput="replaceNotNumber(this)">
	
</div>

<table  width="100%" border="1">
<?php
	if (isset($blog_value) && $blog_value != null) {
		foreach ($blog_value as $key => $value) {
			if ($_COOKIE[DB_USER_ID] == $value[DB_POST_USER_ID]) {
				$num = 1;
			} else {
				$num = 2;
			}
			// echo($num);
			echo "<tr><td valign=\"middle\" align=\"middle\" colspan=\"4\"><li><a href=\"index.php?page=post_detail.php&&post_id=" 
				. $value[DB_POST_ID] . "\">" . htmlspecialchars($value[DB_POST_TITLE]) . "</a></li></td></tr>";
			echo "<tr><td width='20%' valign=\"middle\" align=\"middle\">" . $value[DB_POST_ID] . "</td>";
			echo "<td valign=\"middle\" align=\"middle\"><lin><a href=\"index.php?page=blog.php&author_id=" . $value[DB_POST_USER_ID] . "\">" . htmlspecialchars($value[DB_USER_NAME]) . "</li></td>";
			echo "<td valign=\"middle\" align=\"middle\" colspan='" . $num . "'>" . htmlspecialchars($value[DB_POST_TIME]) . "</td>";
			if ($_COOKIE[DB_USER_ID] == $value[DB_POST_USER_ID]) {
				# code...
				echo "<td valign=\"middle\" align=\"middle\"><input type='button' id='" . $value[DB_POST_ID] . "' name='delete_post' value='delete' onclick='delete_func(this.id)'></td>";
			}
			echo "</tr>";
			echo "<tr><td colspan=\"4\">" . htmlspecialchars($value[DB_POST_POST]) . "</td></tr>";
			echo "<tr><td colspan=\"4\"></td></tr>";
		}
	}

?>
</table>
	</td></tr>
	


</table>

<div class="page_choose">
	<a href="javascript:void(0)" onclick="prev_func()">Prev</a>
	<a href="javascript:void(0)" onclick="next_func()">Next</a>
	<input name='pages' id='pages' type="number" min='1' style="text-align: center" placeholder="page number" oninput='replaceNotNumber(this)'>
	<a href="javascript:void(0)" onclick="jump_func()">Jump</a>
	<input name='page_num' id='page_num' type="number" min='1' style="text-align: center" value="<?php  echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 10; ?>" placeholder="list number" oninput="replaceNotNumber(this)">
	
</div>

<?php
	if (isset($_GET['author_id'])) {
		echo '<form id="delete_form" action="index.php?page=blog.php&author_id=' . $_GET['author_id'] . '" method="post">';
	} else {
		echo '<form id="delete_form" action="index.php?page=blog.php" method="post">';
	}
?>
	<input type="text" id="delete_post_id" name="delete_post_id" style="display:none;">
</form>
</div>

<script type='text/css'>
.data_table {
	width: 800px;
}
</script>

<script type="text/javascript">
	 function delete_func(id) {
	 	var delete_post_id = document.getElementById('delete_post_id');
	 	delete_post_id.value = id;
	 	var form = document.getElementById('delete_form');
	 	var msg = 'delete the post?';
	 	if (confirm(msg)==true){
	   		form.submit();
	 	}
	 }
	function replaceNotNumber(hehe) {
	  var pattern = /[^0-9]/g;
	  if(pattern.test(hehe.value))
	  {
	    hehe.value = hehe.value.replace(pattern,"");
	  }
	}

	function prev_func() {
		var url = document.URL;
		var host = url.split('?')[0];
		var get = url.split('?')[1];
		var temp = get.split('&');
		url = host + '?';
		var gets;

		var page_num = document.getElementById('page_num').value;

		for (var key in temp) {
			var name = (temp[key]).split('=')[0];
			var value = (temp[key]).split('=')[1];
			if (name != 'pages' && name != 'page_num') {
				url = url + name + '=' + value + '&';
			} else if (name == 'pages') {
				if (value > 2) {
					url = url + 'pages' + '=' + (value - 1) + '&';
				} else {
					url = url + 'pages' + '=1' + '&';
				}
			}
		}
	//	alert(temp);
		if (url.indexOf('pages') < 0) {
			url += 'pages=1&';
		}
		if (page_num > 0) {
			url = url + 'page_num=' + page_num;
		} else {
			url = url + 'page_num=10';
		}

		//alert(url);
		window.location.href = url;
	}

	function next_func() {
		var url = document.URL;
		var host = url.split('?')[0];
		var get = url.split('?')[1];
		var temp = get.split('&');
		url = host + '?';
		var gets;

		var page_num = document.getElementById('page_num').value;

		for (var key in temp) {
			var name = (temp[key]).split('=')[0];
			var value = (temp[key]).split('=')[1];
			if (name != 'pages' && name != 'page_num') {
				url = url + name + '=' + value + '&';
			} else if (name == 'pages') {
				if (value > 0) {
					url = url + 'pages' + '=' + (parseInt(value) + 1) + '&';
				} else {
					url = url + 'pages' + '=1' + '&';
				}
			}
		}
		if (url.indexOf('pages') < 0) {
			url += 'pages=1&';
		}
		if (page_num > 0) {
			url = url + 'page_num=' + page_num;
		} else {
			url = url + 'page_num=10';
		}

		//alert(url);
		window.location.href = url;
	}

	function jump_func() {
		//alert();
		var url = document.URL;
		var host = url.split('?')[0];
		var get = url.split('?')[1];
		var temp = get.split('&');
		url = host + '?';
		var gets;

		var pages = document.getElementById('pages').value;
		var page_num = document.getElementById('page_num').value;

		for (var key in temp) {
			var name = (temp[key]).split('=')[0];
			var value = (temp[key]).split('=')[1];
			if (name != 'pages' && name != 'page_num') {
				url = url + name + '=' + value + '&';
			}
		}
		//alert(pages == '');
		if (pages == '') {
			pages = 1;
		}
		if (page_num == '') {
			page_num = 10;
		}
		url += 'pages=' + pages + '&';
		url += 'page_num=' + page_num;

		//alert(url);
		window.location.href = url;
	}
</script>