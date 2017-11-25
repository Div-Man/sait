
<?php	

		echo '<ul>';
			foreach(userList() as $user) {
				echo '<li>
				<a href="?user-id='.$user['id'].'&user-name='.$user['name'].'&action=userList">'.$user['name'].'</a>
				
				<a href="?message=send&user-id='.$user['id']. '&name-user='.$user['name'].'&action=userList">Отправить сообщение</a>
				
				</li>';
			}
		echo '</ul>';
	
	
	if(!empty($_SESSION['auth']) && !empty($_GET['user-id']) && !empty($_GET['name-user']) && !empty($_GET['message'])) {
		require_once 'send-message.php';
	}
	
	if(!empty($_SESSION['auth']) && !empty($_GET['user-id']) && !empty($_GET['user-name'])) {
		require_once 'user-info.php';
	}
?>


	

