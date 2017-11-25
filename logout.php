<?php 
	session_destroy();
	header('Location: ./index.php');
	setcookie('login', '', time()); //удаляем логин
	setcookie('key', '', time()); //удаляем ключ
?>