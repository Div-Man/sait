<?php 
	function showLastVisit() {
		global $link;
		global $_SESSION;
		
		$showData = "SELECT `lastVisit` FROM `users` WHERE id ='". $_SESSION['id']."'";
		$resShowData = $resultUpdateData = mysqli_query($link, $showData);
		$res = mysqli_fetch_assoc($resShowData);
		
		$updateData = "UPDATE users SET lastVisit = null WHERE id='". $_SESSION['id']."'";
		$resultUpdateData = mysqli_query($link, $updateData);
		
		return date("H:i:s d-m-Y", strtotime($res['lastVisit']));
	}
	
	function isPost($key) {
		return $var = (!empty($_POST[$key])) ? $_POST[$key] : '';
	}
	
	function isAdmin() {
		if( $_SESSION['auth'] == true && $_SESSION['status'] == 10) return true;
	}
	
	function delUser($id) {
		global $link;
		$sql = "DELETE FROM users WHERE id='".$id."'";
		mysqli_query($link, $sql);
		header('Location: ./index.php?admin=open');
		die();
	}
	
	function isAccess($status) {
		foreach($status as $key) {
			switch ($key) {
				case 0:
					return 'Забанен';
					break;
					
				case 1:
					return 'Юзер';
					break;
				case 2:
					return 'Модератор';
					break;	
				case 10:
					return 'Администратор';
					break;		
			}	
		}
	} 
	
	function editUserStatus($id, $userStatus) {
		global $link;
		if($userStatus == 'admin') {
			$status = '10';
		}
		else {$status = '1';}
		
		$editStatus = "UPDATE users SET `status` = '".$status."' WHERE id='". $id."'";
		
		mysqli_query($link, $editStatus);	
		header('Location: ./index.php?admin=open');
		die();
	}
	
	function countAdmin() {
		global $link;
		$query = "SELECT COUNT(*) AS countAdmin FROM `users` WHERE status = '10'";
		$admins = mysqli_fetch_assoc(mysqli_query($link, $query)); 
		return $admins;
	}
	
	function countUserBan() {
		global $link;
		$query = "SELECT COUNT(*) AS countUserBan FROM `users` WHERE banned = '1'";
		$usersBan = mysqli_fetch_assoc(mysqli_query($link, $query)); 
		return $usersBan;
	}
	
	function allUsers() {
		global $link;
		$query = "SELECT COUNT(*) AS countUsers FROM `users`";
		$userAll = mysqli_fetch_assoc(mysqli_query($link, $query)); 
		return $userAll;
	}
	
	function userBan($id) {
		global $link;
		$ban = "UPDATE users SET `banned` = '1', `status` = '0' WHERE id='". $id."'";
		mysqli_query($link, $ban);	

		header('Location: ./index.php?admin=open');
		die();
	}
	
	function userBanHour($id, $day = null) {
		global $link;
		if(!empty($day)) {
			$t = '3 day';
		}
		
		else {
			$t = '1 hour';
		}
		
		$data1 = new DateTime($t, new DateTimeZone('Europe/Moscow'));
		$hour = $data1->format('Y-m-d H:i:s');
		
		$ban = "UPDATE users SET `banned` = '1', `status` = '0', `banned_time` = '" . $hour . "' WHERE id='". $id."'";
		mysqli_query($link, $ban);	
		
		header('Location: ./index.php?admin=open');
		die();
	}
	
	function userNoneBan($id) {
		global $link;
		$ban = "UPDATE users SET `banned` = '0', `status` = '1', `banned_time` = null WHERE id='". $id."'";
		mysqli_query($link, $ban);	

		header('Location: ./index.php?admin=open');
		die();
	}
	
	function editUserAdmin($id, $name, $lastName, $email, $age, $language) {
		
		global $link;
		$editUser = "UPDATE users SET 
							`name` = '".$name."', 
							`lastname` = '".$lastName."', 
							`email` = '".$email."', 
							`age` = '".$age."', 
							`language` = '".$language."'
							WHERE id='". $id."'";
		mysqli_query($link, $editUser);
		
		header('Location: ./index.php?admin=open');
		die();
		
	}
	
	function isChecked($key) {
		return (!empty($_POST[$key])) ? 'checked' : '';
	}
	
	function userList() {
		global $link;
		$sql = "SELECT `id`, `name` FROM `users`;";
		$link2 = mysqli_query($link, $sql);
		for ($users = []; $row = mysqli_fetch_assoc($link2); $users[] = $row);
		return $users;
		
	}
	
	function userListForAdmin() {
		global $link;
	
		$sql = "SELECT * FROM `users`;";
		$link2 = mysqli_query($link, $sql);
	
		for ($user = []; $row = mysqli_fetch_assoc($link2); $user[] = $row);
		return $user;
		
	}
	
	function editPassword($id, $newPass, $oldPass) {
		global $link;
		$sql = "SELECT `id`, `password`, `salt` FROM users WHERE id ='".$id."'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $sql)); 
		
		$salt = generationPassword(); //генерируем соль
		
		$saltedPassword = md5($oldPass.$user['salt']); //соленый пароль
		
		if($saltedPassword == $user['password']) {
			$newSaltedPassword = md5($newPass.$salt);
			
			$updatePass = "UPDATE users SET `password` = '".$newSaltedPassword."', `salt` = '".$salt."' WHERE id='". $_SESSION['id']."'";
			mysqli_query($link, $updatePass);
			
			$_SESSION['newPass'] = true;
			
			header('Location: ./index.php');
			die();
		}
		
		else {
			echo 'Текущий пароль неправильный' ;
		}
		
	}
	
	function userInfo($id, $key) {
		global $link;
		$sql = "SELECT `".$key."` FROM users WHERE id ='".$id."'";
		$link2 = mysqli_query($link, $sql);
		for ($user = []; $row = mysqli_fetch_assoc($link2); $user[] = $row);
		
		return $user;
		
	}
	
	function editAge($id, $age, $oldPass) {
		global $link;
		$sql = "SELECT `id`, `password`, `salt` FROM users WHERE id ='".$id."'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $sql)); 
		
		$saltedPassword = md5($oldPass.$user['salt']); //соленый пароль
		
		if($saltedPassword == $user['password']) {
			$updatePass = "UPDATE users SET `age` = '".$age."' WHERE id='". $_SESSION['id']."'";
			mysqli_query($link, $updatePass);
			
			$_SESSION['newAge'] = true;
			
			header('Location: ./index.php');
			die();
		}
		
		else {
			echo 'Текущий пароль неправильный' ;
		}
	}
	
	function editEmail($id, $email, $oldPass) {
		global $link;
		$sql = "SELECT `id`, `password`, `salt` FROM users WHERE id ='".$id."'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $sql)); 
		
		$saltedPassword = md5($oldPass.$user['salt']); //соленый пароль
		
		if($saltedPassword == $user['password']) {
			$updatePass = "UPDATE users SET `email` = '".$email."' WHERE id='". $_SESSION['id']."'";
			mysqli_query($link, $updatePass);
			
			$_SESSION['newEmail'] = true;
			
			header('Location: ./index.php');
			die();
		}
		
		else {
			echo 'Текущий пароль неправильный' ;
		}
	}
	
	function deleteAcc($id, $oldPass) {
		global $link;
		
		$sql = "SELECT `id`, `password`, `salt` FROM users WHERE id ='".$id."'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $sql)); 
		
		$saltedPassword = md5($oldPass.$user['salt']); //соленый пароль
		
		if($saltedPassword == $user['password']) {
		
			$updatePass = "DELETE FROM users WHERE id=" . $id;
			mysqli_query($link, $updatePass);
			
			session_destroy();
			session_start();
			
			$_SESSION['dell-acc'] = true;
			
			header('Location: ./index.php');
			die();
		}
		
		else {
			echo 'Текущий пароль неправильный' ;
		}
	}
	
	function updateCookie($login, $key) {
		global $link;
		$query = 'UPDATE users SET cookie="'.$key.'" WHERE name="'.$login.'"';
		mysqli_query($link, $query);
	}
	
	function isUserCookie() {
		global $link;
		
		if ( !empty($_COOKIE['login']) && !empty($_COOKIE['key']) ) {
		
			$login = $_COOKIE['login']; 
			$key = $_COOKIE['key'];
			
			$query = 'SELECT*FROM users WHERE name="'.$login.'" AND cookie="'.$key.'"';
			$user = mysqli_fetch_assoc(mysqli_query($link, $query)); 
			
			if (!empty($user)) {
				$_SESSION['auth'] = true;
				$_SESSION['id'] = $user['id'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['lastname'] = $user['lastname'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['age'] = $user['age'];
				
				$key = generationPassword();
				setcookie('login', $user['name'], time()+60*60*24*30); //логин
				setcookie('key', $key, time()+60*60*24*30); //случайная строка
					
				updateCookie($user['name'], $key);
			}
		}
	}
	
	function errorInput($value) {
		if(!empty($_POST['btn-reg'])) {
			if(empty($_POST[$value])){
				return '<span style="color: red; font-weight: bold;">Заполните это поле</span><br>';
			}	
		}
	}
	
	function generationPassword() {
		$englishAlphabet = range('a', 'z');
		$arr = [];
		
		$i = 1;
		$j = 1;
		foreach($englishAlphabet as $key) {
			$arr[]=$key;
			if($j % 2 == 0) {
				$arr[]=$i;
			}
			
			if($i >= 9) $i = 1;
			$j++;
			$i++;
		}
		
		$newPassword = '';
		
		for($k = 0; strlen($newPassword) <= 8 ; $k++) {
			$newPassword =  $newPassword . $arr[array_rand($arr, 1)];
		}
		
		return $newPassword;
	}
	
	function validUser($name) {
		global $link;
		$query = 'SELECT*FROM users WHERE name="'.$name.'"';
		$is_login_free = mysqli_query($link, $query);
		$res = mysqli_fetch_assoc($is_login_free);

		 return $res;
	}
	
	function addUser($name, $password, $lastname, $age, $email, $city, $language) {
		global $link;
		
		if(!empty(validUser($name))) {
			return 'Такое имя занято';
		}
		
		$salt = generationPassword(); //генерируем соль
		$saltedPassword = md5($password.$salt); //соленый пароль
		
		$query = 'INSERT INTO users SET 
							name="'.$name.'", 
							password="'.$saltedPassword.'", 
							salt="'.$salt.'", 
							lastname="'.$lastname.'", 
							age="'.$age.'",
							email="'.$email.'",
							city="'.$city.'",
							language="'.$language.'"';
								
								
		mysqli_query($link, $query);
			
		return 'Вы успешно зарегистрированы!';					
	}
	
	function saltLoginPassword($login, $password) {
		global $link;
		$query = 'SELECT `name`, `password`, `salt` FROM users WHERE name="'.$login.'"';
		$is_login = mysqli_query($link, $query);
		$res = mysqli_fetch_assoc($is_login);
		
		if(empty($res)) {return false;}
		
		$pass = md5($password.$res['salt']);
		
		if($res['password'] == $pass) {
			return true;
		}
		
		return false;
	}
	
	function isPassword() {
		if(!empty($_GET['pass'])) {
			return generationPassword();
		}
		return '';
	}
	
	function isAuth() {
		if(empty($_SESSION['auth'])) {
			return false;
		}
		return true;
	}
	
	function isNotAuth() {
		if(empty($_SESSION['auth'])) {
			return true;
		}
		return false;
	}
	
	function user($key) {
		return $_SESSION[$key];
	}
	
	function getUser($id = null) {
		global $link;
		
		$query2 = "SELECT * FROM `users` WHERE `id` = '" . $id . "'";
		$result2 = mysqli_query($link, $query2);
		$user2 = mysqli_fetch_assoc($result2);
		
		if(empty($user2)) {
			return $_SESSION;
		}
		
		else {
			return $user2;
		}
	}
	
	function sendMessage($myId, $recipientId, $text) {
		global $link;
		$query = 'INSERT INTO `messages` SET 
							recipient_id="'.$recipientId.'", 
							sender_id="'.$myId.'", 
							message="'.$text.'",
							login="'.$_SESSION['name'].'"';
							
		mysqli_query($link, $query);
		
		$_SESSION['mess'] = true;
		header('Location: ./?read-message=' . $_SESSION['id']);
		die();
		//$_SERVER['HTTP_REFERER'];
	}
	
	function showMyMessageCount($id){
		global $link;
		$query = "SELECT COUNT(*) AS count FROM `messages` WHERE recipient_id = '".$id."' AND `read` = 0 OR yes_answer = 1 AND sender_id = '".$id."'";
		
		$message =  mysqli_fetch_assoc(mysqli_query($link, $query)); 
		
		return $message;
	}
	
	function showMyMessage($id){
		global $link;
		$query = "SELECT * FROM `messages` WHERE recipient_id = '".$id."' OR sender_id = '".$id."'";
		$link2 = mysqli_query($link, $query);
		for ($message = []; $row = mysqli_fetch_assoc($link2); $message[] = $row);
		
		return $message;	
	}
	
	function answerMessage($id) {
		global $link;
		$query = "SELECT * FROM `messages` WHERE id = '".$id."'";
		
		$message =  mysqli_fetch_assoc(mysqli_query($link, $query)); 
		
		return $message;
	}
	
	function addAnswerMessage($idMessage, $text) {
		global $link;
		$update = "UPDATE messages SET `answer` = '".$text."', `read` = 1, yes_answer = 1 WHERE id='". $idMessage."'";
		
		mysqli_query($link, $update);
			
		$_SESSION['mess'] = true;
		header('Location: ./?read-message=' . $_SESSION['id']);
		die();
	}
	
	function readMessage($id) {
		global $link;
		$update = "UPDATE messages SET `yes_answer` = 2 WHERE id='". $id."'";
		
		mysqli_query($link, $update);
		header('Location: ./?read-message=' . $_SESSION['id']);
		die();
	}
	
	function hiddenMessForUser($idUser, $idMess) {
		global $link;
		
		$showId = "SELECT `hidden_user` FROM `messages` WHERE id='". $idMess."'";
		$message =  mysqli_fetch_assoc(mysqli_query($link, $showId));
		
		if(!empty($message['hidden_user'])) {
			
			$hiddenForUser = $message['hidden_user'] . '-' . $_SESSION['id'];
			
			$update = "UPDATE messages SET `hidden_user` = '".$hiddenForUser."' WHERE id='". $idMess."'";
		
			mysqli_query($link, $update);
			
			$delMess = "DELETE FROM messages WHERE id=" . $idMess;
			mysqli_query($link, $delMess); //если это убрать, то сообщения будут скрываться, а не удаляться и будет видно только для админа
			
			$_SESSION['del-mess'] = true;
			header('Location: ./?read-message=' . $_SESSION['id']);
			die();
		}
		
		else {
			$update = "UPDATE messages SET `hidden_user` = '".$idUser."' WHERE id='". $idMess."'";
			mysqli_query($link, $update);
			
			$_SESSION['del-mess'] = true;
			header('Location: ./?read-message=' . $_SESSION['id']);
			die();
		}
	}
	
	
?>