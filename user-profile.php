<?php
	require_once 'functions.php';
	
	if(isNotAuth()) header('Location: ./index.php');
	
	$group = [
		'0' => 'Забанен', 
		'1' => 'Юзер', 
		'2' => 'Модератор', 
		'10' => 'Администратор'
	];
	
	$role = $group[$_SESSION['status']];
	
?>
<div class="block">
	<p>Добро пожаловать <?php echo user('name')?> <a href="?action=logout">Выход</a></p>
	<p>Вы находитесь в группе <span style="color: green; font-weight: bold"><?php echo $role;?></span></p>
	<p>Дата последнего захода <?php echo showLastVisit();?></p>
	
	<?php 
		if(isAdmin()) {
			echo '<a href="?admin=open">Открыть админку</a>';
		}
		
		if(isAdmin() && !empty($_GET['admin'])) {
			require_once 'admin.php';
		}
	?>
	
	
</div>

<div class="block">
	<a href="?action=userList">Список пользователей</a>
	<?php 
		if(!empty($_GET['action']) && $_GET['action'] === 'userList') {
			require 'list-user.php';
		}
	?>
	


<p><a href="?read-message=<?php echo $_SESSION['id'];?>">Сообщения (<?php echo showMyMessageCount($_SESSION['id'])['count']?>)</a></p>

<?php 
	if(!empty($_GET['read-message']) || !empty($_GET['answer-question'])) {
		require_once 'show-message.php';
	}
?>

<p><a href="?action=edit-password">Сменить пароль</a></p>
<p><a href="?action=edit-age">Сменить возраст</a></p>
<p><a href="?action=edit-email">Сменить Email</a></p>
<p><a style="color: red; font-weight: bold;" href="?action=dell-acc">Удалить свой аккаунт</a></p>
<?php 
	if(!empty($_GET['action']) && $_GET['action'] === 'edit-password') {
		require_once 'edit-password.php';
	}
	
	if(!empty($_SESSION['newPass'])) {
		echo '<p style="color: green; font-weight: bold">Пароль успешно изменён!</p>';
		$_SESSION['newPass'] = false;
	}
	
	if(!empty($_GET['action']) && $_GET['action'] == 'edit-age') {
		require_once 'edit-age.php';
	}
	
	if(!empty($_GET['action']) && $_GET['action'] === 'dell-acc') {
		require_once 'dell-acc.php';
	}
	
	if(!empty($_SESSION['newAge'])) {
		echo '<p style="color: green; font-weight: bold">Возраст успешно изменён!</p>';
		$_SESSION['newAge'] = false;
	}
	
	if(!empty($_GET['action']) && $_GET['action'] === 'edit-email') {
		require_once 'edit-email.php';
	}
	
	if(!empty($_SESSION['newEmail'])) {
		echo '<p style="color: green; font-weight: bold">Email успешно изменён!</p>';
		$_SESSION['newEmail'] = false;
	}
	
?>

<p style="font-weight: bold;">Мои данные:</p>
<ul>
	<li>id: <?php echo user('id');?></li>
	<li>Имя: <?php echo user('name');?></li>
	<li>Фамилия: <?php echo user('lastname');?></li>
	<li>Email: <?php echo user('email');?></li>
	<li>Возраст: <?php echo user('age');?></li>
	<li>Язык: <?php echo user('language');?></li>
	<li>Дата регистрации: <?php echo user('data_reg');?></li>
</ul>


<?php 
	if(!empty($_GET['action'])) {
		if($_GET['action'] == 'logout') {
			require_once 'logout.php';
		}
	}
?>

</div>