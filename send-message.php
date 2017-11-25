<p>Отправить собщение пользователю <?php echo $_GET['name-user']?></p>

<form action="" method="post">
	<p>Текст</p>
	<textarea rows="10" cols="45" name="text"></textarea>
	<p><input type="submit"></p>
</form>

<?php 
	if(!empty($_SESSION['auth']) && !empty($_POST['text'])) {
		if($_GET['user-id'] == $_SESSION['id']) {
			echo 'Вы нем можете отправить самому себе сообщение!';
		}
		else {
			echo sendMessage($_SESSION['id'], $_GET['user-id'], $_POST['text']);
			
		}
		
	}
?>