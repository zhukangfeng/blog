<form name="contact" method="post" action="model/contact.php">

<div class="left">
	<label>Your E-mail: </label><br />
	<input type="text" name="sender" id="sender" maxlength="40" value="<?php
	  if (isset($_COOKIE[DB_USER_MAIL])) { 
	  		echo($_COOKIE[DB_USER_MAIL]); 
	  	}
	 ?>"> <br />
	<label>Receiver's E-mail</label><br>
	<input type="text" name="receiver" id="receiver" maxlength="40" value="<?php echo $receiver; ?>"> <br />



	What do you want to tell? <br />
	<textarea id="context" name="context" rows="20" cols="80" onpropertychange="this.style.posHeight=this.scrollHeight"
	                                        onfocus="this.style.posHeight=this.scrollHeight" style="overflow:auto"></textarea> <br />

	<br />
	<input type="submit" name="send_mail" id="send_mail" value="send mail">
	
</div>


</form>
