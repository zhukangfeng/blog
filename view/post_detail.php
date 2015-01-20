<?php
	include_once ("constant/constant.php");
	//print_r($value);
?>
<body onload="init();">
	<div class="left">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">

			<tr><td align="center" valign="middle">
				<form name="post_detail" action="model/post_detail.php" method="post">
					<table  width="90%" border="1" >
						<tr>
							<td valign="middle" align="middle" colspan="5"> <input type="text" id="title" name="title" maxlength="100" readonly="true" value="<?php echo $value[DB_POST_TITLE]; ?>"</td>
						</tr>
						<tr>
							<td>Post id: <input type="text" id="id" name="id" readonly="true" value="<?php echo $value[DB_POST_ID]; ?>"> </td>
							<td><li><a href='index.php?page=contact.php&receiver_id=<?php echo $value[DB_POST_USER_ID];?>'>Post auther: <input type="text" id="auther" name="auther" readonly="true" value="<?php echo $value[POST_AUTHOR]; ?>"></a></li> </td>
							<td>Entry time: <input type="text" id="entry_time" name="entry_time" readonly="true" value="<?php echo $value[DB_POST_TIME]; ?>"></td>
							<td>Modify time: <input type="text" id="modify_time" name="modify_time" readonly="true" value="<?php echo $value[DB_POST_MODIFY_TIME]; ?>"></td>
							<td>Post place: <input type="text" id="place" name="place" readonly="true" value="<?php echo $value[DB_POST_PLACE]; ?>"></td>
						</tr>
						<tr>
							<td colspan="5" align="center"><textarea id="post" name="post" readonly="true" style='border: 1px solid #94BBE2;width:100%;' rows=15 onpropertychange='this.style.posHeight=this.scrollHeight' 
							 onfocus='textarea.style.posHeight=this.scrollHeight'><?php echo $value[DB_POST_POST]; ?></textarea></td>
						</tr>
						<?php

						//	echo $value[DB_POST_USER_ID] . "abc" . $_COOKIE[DB_USER_ID];


							if ($value[DB_POST_USER_ID] == $_COOKIE[DB_USER_ID]) {

								$modify = '<tr><td align="center" colspan="5">
											<input type="button" id="modify" name="modify" value="modify" onclick="modify_func()">    <input type="submit" id="submit" name="submit" value="confirm"  style="display:none;"> 
											</td></tr>';
								echo $modify;
							}

						?>	
					</table>
				</form>
			</td></tr>
			<tr><td valign="center" align="center">
				<form action="index.php?page=comment.php" method="post">
					<table  width="90%" border="1">
						<tr>
							<td width="10%"><label> Comment:</label></td>
							<td width="10%"><label id="comment_label" name="comment_label">comment post:</label><input type="text" id="post_detail_url" name="post_detail_url" style="display:none;" value=""></td>
							<td width="60%" valign="center">
								<textarea id='comment_textarea' name='comment_textarea' row=20 style='width:100%' onpropertychange='this.style.posHeight=this.scrollHeight'></textarea>
								<input type='text' name="comment_id" id='comment_id' value="0" style="display:none;"> <input type="text" id="post_id" name="post_id" style="display:none;" value="<?php echo $value[DB_POST_ID]; ?>">
							</td>
							<td width="20%" align="center"><input type="submit" id="comment" name="comment" value="comment" onclick="submit_func()"><input type="button" id="comment_post" style="display:none;" value="comment_post" onclick="comment_post_func()"></td>
						</tr>
					</table>
				</form>
				<table  width="90%" border="1">
					<?php
					/*
						$comment = array(array(DB_COMMENT_ID => 100,
										 DB_POST_ID => 2,
										 POST_AUTHOR => 'POST AUTHER',
										 DB_COMMENT_FATHER_COMMENT_ID => 0,
										 DB_COMMENT_COMMENT => 'TEST COMMENT                23233jslajflsdjflsakjflsdj',
										 DB_COMMENT_USER_ID => 1,
										 COMMENT_AUTHOR => 'TEST_AUTHER',
										 DB_COMMENT_TIME => '20200101 10:01:11',
										 FATHER_COMMENT_AUTHOR => 'TEST FATHER COMMENT AUTHOR'
										),
									array(DB_COMMENT_ID => 101,
										 DB_POST_ID => 2,
										 POST_AUTHOR => 'POST AUTHER111',
										 DB_COMMENT_FATHER_COMMENT_ID => 0,
										 DB_COMMENT_COMMENT => 'TEST COMMENT111                23233jslajflsdjflsakjflsdj',
										 DB_COMMENT_USER_ID => 2,
										 COMMENT_AUTHOR => 'TEST_AUTHER111',
										 DB_COMMENT_TIME => '20100101 10:01:11',
										 FATHER_COMMENT_AUTHOR => 'TEST FATHER COMMENT AUTHOR111'
										)
						);
	*/
						//print_r($comment);
						if (isset($comment) && $comment != null) {
							foreach ($comment as $key => $value) {
								# code...
								$replyer = "<td width='20%'><label>" . $value[COMMENT_AUTHOR] . " reply " . $value[FATHER_COMMENT_AUTHOR] . "</label></td>";
								$comment = "<td width='50%'><textarea readonly='true' style='width:100%' onpropertychange='this.style.posHeight=this.scrollHeight' name='" . DB_COMMENT_COMMENT 
											. "' id='" . DB_COMMENT_COMMENT .  "'>" . $value[DB_COMMENT_COMMENT] . "</textarea></td>";
								$time = "<td width='20%'><label>time: </label><input type='text' readonly='true' name='" . DB_COMMENT_TIME . "' value='" . $value[DB_COMMENT_TIME] . "'></td>";
								$replay = "<td width='10%' align='center'><input type='button' id='" . $value[DB_COMMENT_ID] . "' name='" . $value[COMMENT_AUTHOR] . "' value='replay' onclick='replay_func(this.id, this.name)'></td>";
							
								$html = "<tr>" . $replyer . $comment . $time . $replay . "</tr>";

								echo $html;
							}
						}
					?>
				</table>

			</td></tr>
		</table>
	</div>
</form>
</body>

<style type="text/css">
textarea {
    border: 0 none white;
    overflow: hidden;
    padding: 0;
    outline: none;
    resize: none;
}
</style>

<script type="text/javascript">
	function modify_func() {
		var modify = document.getElementById("modify");
	    modify.style.display="none";
	    var submit = document.getElementById("submit");
	    submit.style.display="block";

	    var title = document.getElementById("title");
	    title.style.background = "grey";
	    title.readOnly = false;

	    var place = document.getElementById("place");
	    place.style.background = "grey";
	    place.readOnly = false;

	    var post = document.getElementById("post");
	    post.style.background = "grey";
	    post.readOnly = false;
	}

	function replay_func(id, name) {
		//alert(id);

		var label_commend = document.getElementById("comment_label");
		label_commend.innerHTML = "comment " + name + ":";
		var comment_post = document.getElementById('comment_post');
		comment_post.style.display = "block";
		var comment_id = document.getElementById("comment_id");
		//alert(comment_id.value);

		comment_id.value = id;

		var comment = document.getElementById("comment_textarea");
		comment.focus();
		//alert(comment_id.value);

		//window.scrollHeight = label_commend.offsetTop;
		
	}

	function comment_post_func() {
		var label_commend = document.getElementById("comment_label");
		label_commend.innerHTML = "comment post:";
		var comment_id = document.getElementById("comment_id")
		//alert(comment_id.value);
		comment_id.value = '0';
	//	alert(comment_id.value);
		var comment_post = document.getElementById("comment_post");
		comment_post.style.display = "none";
		var comment = document.getElementById("comment_textarea");
		comment.focus();
		
		
	}

	function submit_func() {
		var post_detail_url = document.getElementById("post_detail_url");
		post_detail_url.value = window.location.href;	
	}





	var observe;
	if (window.attachEvent) {
	    observe = function (element, event, handler) {
	        element.attachEvent('on'+event, handler);
	    };
	}
	else {
	    observe = function (element, event, handler) {
	        element.addEventListener(event, handler, false);
	    };
	}
	function init () {
	    var text = document.getElementById('post');
	    function resize () {
	        text.style.height = 'auto';
	        text.style.height = text.scrollHeight+'px';
	    }
	    /* 0-timeout to get the already changed text */
	    function delayedResize () {
	        window.setTimeout(resize, 0);
	    }
	    observe(text, 'change',  resize);
	    observe(text, 'cut',     delayedResize);
	    observe(text, 'paste',   delayedResize);
	    observe(text, 'drop',    delayedResize);
	    observe(text, 'keydown', delayedResize);
	    text.focus();
	    text.select();
	    resize();
	}
</script>