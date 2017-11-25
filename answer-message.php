<p>Ответ на сообщение от пользователя <?php echo $_GET['name-user']?></p>

<?php 

/*
	echo '<pre>';
			print_r(answerMessage($_GET['message-id']));
		echo '</pre>';
		

	echo '<p>';
		echo (answerMessage($_GET['message-id'])['message']);
	echo '</p>';
	*/
?>

<form action="" method="post">
	<p>Текст</p>
	<textarea rows="10" cols="45" name="text"></textarea>
	<p><input type="submit" value="Ответить"></p>
</form>

<?php 
	if(!empty($_SESSION['auth']) && !empty($_POST['text'])) {
		addAnswerMessage($_GET['message-id'], $_POST['text']);
	}
?>