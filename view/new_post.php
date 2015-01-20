<?php
	include_once ("constant/constant.php");
	//print_r($value);
?>
<body onload="init();">
	<div class="left">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">
			<form action="index.php?page=new_post.php" method="post">
				<tr>
					<td  align="center" valign="middle">
						<table width="100%">
							<tr>
								<td align="right" width="45%"><label>Title: </label></td>
								<td width="45%"><input type="text" maxlength="40" id="title" name="title"></td>
							</tr>
							<tr>
								<td align="right"><label>Place: </label></td>
								<td><input type="text" maxlength="40" id="place" name="place"></td>
							</tr>
							<tr>
								<td colspan="2" align="center"><textarea id="post" name="post" style='border: 1px solid #94BBE2;width:90%;' rows=15 onpropertychange='this.style.posHeight=this.scrollHeight' 
								onfocus='textarea.style.posHeight=this.scrollHeight'></textarea></td>
							</tr>
							<tr>
								<td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="post"></td>
							</tr>
						</table>
					</td>
				</tr>
			</form>
		</table>
	</div>
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