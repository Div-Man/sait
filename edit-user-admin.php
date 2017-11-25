Редактирование пользователя

<form action="" method="POST">
	<p><label>id: <?php echo userInfo($_GET['red-user-admin'],'id')[0]['id'];?><input type="hidden" name="id" value="<?php echo userInfo($_GET['red-user-admin'],'id')[0]['id'];?>"></label></p>
	<p><label>Имя: <input type="text" name="name" value="<?php echo userInfo($_GET['red-user-admin'],'name')[0]['name'];?>"></label></p>
	<p><label>Фамилия: <input type="text" name="lastName" value="<?php echo userInfo($_GET['red-user-admin'],'lastname')[0]['lastname'];?>"></label></p>
	<p><label>Email: <input type="text" name="email" value="<?php echo userInfo($_GET['red-user-admin'],'email')[0]['email'];?>"></label></p>
	<p><label>Возраст: <input type="text" name="age" value="<?php echo userInfo($_GET['red-user-admin'],'age')[0]['age'];?>"></label></p>
	<p><label>Язык: <input type="text" name="language" value="<?php echo userInfo($_GET['red-user-admin'],'language')[0]['language'];?>"></label></p>
	<input type="submit" value="Сохранить" name="redact-user-admin">
</form>
<br>
<br>

<?php 
	if(!empty($_POST['redact-user-admin']) && isAdmin()) {
		if(!empty($_POST['id']) 
						&& !empty($_POST['id']) 
						&& !empty($_POST['name']) 
						&& !empty($_POST['lastName']) 
						&& !empty($_POST['email']) 
						&& !empty($_POST['age']) 
						&& !empty($_POST['language']) 
			){
				editUserAdmin(
						$_POST['id'], 
						$_POST['name'], 
						$_POST['lastName'], 
						$_POST['email'], 
						$_POST['age'], 
						$_POST['language']
					);
			}
			
			else {
				echo 'Заполните все поля';
			}
		
	}

?>