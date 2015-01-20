<div class="left">
	<form action="index.php?page=login.php" method="post">
		<table cellpadding="0" cellspacing="1" border="0">
	    	<tr>
	    		<td><label><input type='radio' id='radio' name='radio' value="user_id" checked="0" onclick="id_login_func()"> User id login:</label></td>
	    		<td><input type="text" name="user_id" maxlength="40" id="user_id" 
	    			onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" /></td>
	    	</tr>
	    	<tr>
	    		<td><label><input type='radio' id='radio' name='radio' value="user_mail" onclick="mail_login_func()"> Mail login:</label></td>
	    		<td><input type="text" id="mail" name="mail" readonly="true"></td>
	    	</tr>
	        <tr><td align="center">Password:</td><td><input type="password" name="password"/></td></tr>
	        <tr><td></td><td align="center"><input type="submit" name="login" id="login" class="type_white" value="login by id"/></td></tr>
	    </table>

	</form>
</div>

<script type="text/javascript">
	function id_login_func() {
	//	confirm("abc");
		var mail = document.getElementById('mail');
		mail.readOnly = true;
		
		//mail.setAttribute("readOnly", true);
		var user_id = document.getElementById('user_id');
		user_id.readOnly = false;
		user_id.focus();

		var login = document.getElementById('login');
		login.value = "login by id";
		//user_id.setAttribute("readOnly", false);
		
	}

	function mail_login_func() {
	//	confirm("123");
		var user_id = document.getElementById('user_id');
		var mail = document.getElementById('mail');
		mail.readOnly = false;
		user_id.readOnly = true;
		mail.focus();

		var login = document.getElementById('login');
		login.value = "login by mail";
		// user_id.setAttribute("readOnly", true);
		// mail.setAttribute("readOnly", false);


	}
</script>