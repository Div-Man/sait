<form action="" method="POST">
	<p><label><input type="text" name="age" value="<?php echo userInfo($_SESSION['id'], 'age')['0']['age'];?>"> Возраст</label></p>
	<p><label><input type="password" name="oldPass"> Текущий пароль для подтверждения</label></p>
	<input type="submit" value="Применить">
</form>

<?php 
	if(!empty($_POST['age']) 
			&& !empty($_POST['oldPass'])
			&& !empty($_SESSION['id'])
	) {
			editAge($_SESSION['id'], $_POST['age'], $_POST['oldPass']);
			
		}
		
	
?>