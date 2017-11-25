<h2>Авторизация</h2>

<form action='./index.php' method='POST'>
	<input name='login' value="<?php echo isPost('login');?>">
	<input name='password' type='password'>
	<label>Запомнить пароль<input name='remember' type='checkbox' value='1' <?php echo isChecked('remember');?>></label>
	<input type='submit' value='Отправить'>
</form>

<?php
	
	if(!empty($_POST['login']) && !empty($_POST['password'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$query = "SELECT * FROM `users` WHERE `name` = '" . $login . "'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		
		
		if(!empty($user)) {
			$salt = $user['salt'];
			$saltedPassword = md5($password.$salt);
			
			$hour1 = new DateTime('now', new DateTimeZone('Europe/Moscow'));
			$razban1 = $hour1->getTimestamp();	
			
			if(!empty($user['banned_time'])) {
			
			$hour2 = new DateTime($user['banned_time'], new DateTimeZone('Europe/Moscow'));
			$razban2 = $hour2->getTimestamp();	
			
				if(($razban2 - $razban1) < 0) {
					userNoneBan($user['id']);
					header('Location: ./index.php');
					die();
				}
				else {
					echo 'Вы забанены до ' . $user['banned_time'];
				}
				
			}
			elseif($user['banned'] == '1') {
				echo 'Вы забанены';
			}
			
			elseif($saltedPassword === $user['password']) {
				$_SESSION['auth'] = true;
				$_SESSION['id'] = $user['id'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['lastname'] = $user['lastname'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['age'] = $user['age'];
				$_SESSION['language'] = $user['language'];
				$_SESSION['data_reg'] = $user['data_reg'];
				$_SESSION['status'] = $user['status'];
				
				if(!empty($_POST['remember']) && $_POST['remember'] === '1') {
					$key = generationPassword();
					setcookie('login', $user['name'], time()+60*60*24*30); //логин
					setcookie('key', $key, time()+60*60*24*30); //случайная строка
					
					updateCookie($user['name'], $key);
				}
				
				header('Location: ./index.php');
			}
			
			else {
				echo 'Неверный логин или пароль';
			}
		}
		
		else {
			echo 'Неверный логин или пароль';
		}
	
		
		
	}
?>