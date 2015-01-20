
<div class="left">
	<form action="index.php?page=register.php" method="post">
	<table vali=centerborder="0">
		<tr>
			<td align='center' colspan='2'> Register </td>
		</tr>
		</td>
		<tr>
			<td>Name:</td> <td><input type="text" name="user_name" maxlength="40"></td>
		</tr>
		<tr>
			<td>Mail:</td> <td><input type="text" name="user_mail" maxlength="40"></td>	
		</tr>
		<tr>
			<td>Password:</td> <td><input type="password" name="user_password"></td>
		</tr>
		<tr>
			<td>Confirm:</td> <td><input type="password" name="user_password_confirm"></td>
		</tr>
		<tr>
			<td>Birthday:</td> <td><input type="date" name="user_birthday"></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="register" value="register"></td>
			<td align="center"><input type="button" name="cancel" value="cancel" onclick='func_cancel()'></td>
		</tr>
	</table>
	</form>
</div>

<script type="text/javascript">
	function func_cancel() {
		//print("abd");
		window.location.href='index.php';
	}
</script>


