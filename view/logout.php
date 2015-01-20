<div class="center">
	<input type="button" value="logout" name="submit" onclick="submit_func()">
	<input type="button" value="cancel" onclick="cancel_func()">
	<script type="text/javascript">
		function cancel_func() {
			window.location.href = "../";
		}

		function submit_func() {
			var keys=document.cookie.match(/[^ =;]+(?=\=)/g); 
			if (keys) { 
				for (var i = keys.length; i > 0; i--) {
					document.cookie=keys[i]+'=0;expires=' + new Date( 0).toUTCString();
				}
			} 
			window.location.href = "../";
		}
		
	</script>
</div>
