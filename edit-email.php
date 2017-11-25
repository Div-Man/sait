<form action="" method="POST">
	<p><label><input type="text" name="email" value="<?php echo userInfo($_SESSION['id'], 'email')[0]['email'];?>"> Email</label></p>
	<p><label><input type="password" name="oldPass"> Текущий пароль для подтверждения</label></p>
	<input type="submit" value="Применить">
</form>

<?php 
	if(!empty($_POST['email']) 
			&& !empty($_POST['oldPass'])
			&& !empty($_SESSION['id'])
	) {
			editEmail($_SESSION['id'], $_POST['email'], $_POST['oldPass']);
			
		}
		
	
?>