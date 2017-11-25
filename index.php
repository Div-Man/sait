<?php 
	session_start();
	error_reporting(E_ALL);
	require_once 'db.php';
	require_once 'functions.php';
	
	if(!empty($_SESSION['dell-acc'])) {
		echo '<p style="color: green; font-weight: bold">Ваш аккаунт удалён!</p>';
		$_SESSION['dell-acc'] = false;
	}
	
	
?><!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	
	<?php
		if(empty($_SESSION['auth'])) {require_once 'reg.php';}
		
		isUserCookie();
	
		if(isAuth()) require_once 'user-profile.php';
		else require_once 'auth.php';
		?>
	</body>
</html>	
	
	
	
	
	


