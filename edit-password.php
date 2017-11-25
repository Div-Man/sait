<form action="" method="POST">
	<p><label><input type="password" name="pass1" value="<?php echo isPost('pass1');?>"> Новый пароль</label></p>
	<p><label><input type="password" name="pass2" value="<?php echo isPost('pass2');?>"> Ещё раз</label></p>
	<p><label><input type="password" name="oldPass"> Текущий пароль для подтверждения</label></p>
	<input type="submit" value="Применить">
</form>

<?php 
	if(!empty($_POST['pass1']) 
			&& !empty($_POST['pass2']) 
			&& !empty($_POST['oldPass'])
			&& !empty($_SESSION['id'])
	) {
		if($_POST['pass1'] === $_POST['pass2']) {
		
			if(strlen($_POST['pass2']) < 6  || strlen($_POST['pass2']) > 10) {
				echo 'Пароль должен быть от 6 до 10 символов';
				return;
			}
			editPassword($_SESSION['id'], $_POST['pass2'], $_POST['oldPass']);
		}
		else {
			echo 'Новые пароли не совпадают';
		}
	}
?>