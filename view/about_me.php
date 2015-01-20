<?php

//echo "this about_me.php (from file view)";
 




?>


<form name="form_user_info" method="post" action="controller/about_me.php">
	<div class="left">
		<table width="60%" border="0" cellspacing="0" cellpadding="0">
			<tr> <td valign="middle">
				<table>
					<?php
						//user name
						echo "<tr><td>" . "Name: </td><td><input name='" . DB_USER_NAME . "' type='text' maxlength = '40' readOnly='true' value='";
						echo $user_info[DB_USER_NAME] . "' id='text_name'><tr><td>";

						//user id
						echo "<tr><td>" . "ID  : </td><td><input name='" . DB_USER_ID . "' type='text' maxlength = '40' readOnly='true' value='";
						echo $user_info[DB_USER_ID] . "' id='text_id'><tr><td>";

						//user mail

						echo "<tr><td>" . "Mail  : </td><td><input name='" . DB_USER_MAIL . "' type='text' maxlength = '40' readonly='true'  value='";
						echo $user_info[DB_USER_MAIL] . "'' id='text_mail'><tr><td>";
						if ($error) {
							echo "<h1>Please enter a name </h1>";
						}

						echo "<tr><td>" . "Birthday  : </td><td><input name='" . DB_USER_BIRTHDAY . "' type='date' readonly='true'  value='";
						echo $user_info[DB_USER_BIRTHDAY] . "'' id='birthday'><tr><td>";
						
						echo "<tr><td>" . "Password  : </td><td><input name='" . DB_USER_PASSWORD . "' type='password' maxlength = '40' readonly='true' id='password_password'><tr><td>";
						echo "<tr><td>" . "Confirm  : </td><td><input name='" . PASSWORD_CONFIRM . "' type='password' maxlength = '40' readonly='true' id='password_confirm'><tr><td>";
						echo "<tr><td></td></tr>";
						

						echo "<tr><td><input type='submit' name='modify_confirm' value='confirm' id='submit_confirm'></td>";
						echo "<td><input type='button' name='user_info_modify' value='modify' id='button_modify' onClick='func_modify()'></td></tr>";
						

					?>

				</table>
			</td></tr>
		</table>
	</div>
	
</form>


<script type="text/javascript">
	function func_modify(){
		var input_user = document.getElementById('text_name');
		var input_mail = document.getElementById('text_mail');
		var input_password = document.getElementById('password_password');
		var input_password_confirm = document.getElementById('password_confirm');
		var input_birthday = document.getElementById('birthday');
		//input_user.readonly = 'false';
		//input_user.value = 'sdfa'
		//input_user.setAttribute('readOnly', 'false');
		input_user.readOnly = false;
		input_user.style.backgroundColor="grey";
		input_mail.readOnly = false;
		input_mail.style.backgroundColor="grey";
		input_birthday.readOnly = false;
		input_birthday.style.backgroundColor="grey";
		input_password.readOnly = false;
		input_password.style.backgroundColor="grey";
		input_password_confirm.readOnly = false;
		input_password_confirm.style.backgroundColor="grey";
		
	
	}

</script>
