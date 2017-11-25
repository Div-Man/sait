<?php 

	if(!empty($_SESSION['mess'])) {
		echo '<p style="color: red; font-weight: bold">Сообщение отправлено</p>';
		$_SESSION['mess'] = false;
	}
	
	if(!empty($_SESSION['del-mess'])) {
		echo '<p style="color: red; font-weight: bold">Сообщение удалено</p>';
		$_SESSION['del-mess'] = false;
	}
	
	

	if(!empty($_GET['answer-question']) && !empty($_GET['name-user'])) {
		require_once 'answer-message.php';
	}
	else {
		foreach(showMyMessage($_SESSION['id']) as $mess) {
		
		$users = explode('-', $mess['hidden_user']);
		
		if(!in_array($_SESSION['id'], $users)) {
			echo '<div>';
				echo '<p>Отправитель: <b>'. $mess['login'] . '</b></p>';
				echo '<span>Вопрос</span>';
				echo '<p>'.$mess['message'].'</p>';
				
				if(!empty($mess['answer'])) {
					echo '<p>Получатель: <b>'. getUser($mess['recipient_id'])['name'] . '</b></p>';
					echo '<span>Ответ</span>';
					echo '<p>'.$mess['answer'].'</p>';
					
					if(($mess['sender_id'] == $_SESSION['id']) && $mess['yes_answer'] != '2') {
						echo '<a href="?read2=ok&answer-id='.$mess['id'].'&read-message='.$_GET['read-message'].'">Отметить, что прочитанное    </a>';
					}
					
					if(!empty($_GET['read2']) && !empty($_GET['answer-id'])) {
						readMessage($_GET['answer-id']);
					}
				}
				else {
					if($mess['sender_id'] != $_SESSION['id']) {
						echo '<a href="?answer-question=ok&name-user='.$mess['login'].'&user-id='.$mess['sender_id'].'&message-id='.$mess['id'].'">Ответить       </a>';
					}
				}
				echo '<a href="?hidden-mess-for-user=' . $_SESSION['id']. '&read-message='.$_GET['read-message'].'&message-id='.$mess['id'].'">Удалить</a>';
				
			echo '</div>';
			
			echo '<hr>';
		}
	}
		if(!empty($_GET['hidden-mess-for-user'])) {
			hiddenMessForUser($_GET['hidden-mess-for-user'], $_GET['message-id']);	
		}
	}
	
?>
