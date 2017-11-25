<form action="" method="POST">
	<p><label><input type="password" name="oldPass"> Текущий пароль для подтверждения</label></p>
	<input type="submit" value="Применить">
</form>

<?php 
	if(!empty($_POST['oldPass']) 
			&& !empty($_POST['oldPass'])
			&& !empty($_SESSION['id'])
	) {
			deleteAcc($_SESSION['id'], $_POST['oldPass']);
			
		}
		
	
?>