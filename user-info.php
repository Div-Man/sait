<?php 
		$id = $_GET['user-id'];
		
		echo '
			<ul>
				<li>id: ' . getUser((int)$id)['id']. '</li>
				<li>Имя:' . getUser((int)$id)['name']. '</li>
				<li>Фамилия: ' . getUser((int)$id)['lastname']. '</li>
				<li>Email: ' . getUser((int)$id)['email']. '</li>
				<li>Возраст: ' . getUser((int)$id)['age']. '</li>
				<li>Язык: ' . getUser((int)$id)['language']. '</li>
				<li>Дата регистрации: ' . getUser((int)$id)['data_reg']. '</li>
			</ul>
		';
?>