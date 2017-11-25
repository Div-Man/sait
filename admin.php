<div class="admin-block">
	<p>Административная панель</p>
</div>

<hr>
<p>Количество администраторов: <?php echo countAdmin()['countAdmin'];?></p>
<p>Количество забаненых: <?php echo countUserBan()['countUserBan'];?></p>
<p>Всего пользоватетей: <?php echo allUsers()['countUsers'];?></p>
<hr>

<table>
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия</th>
		<th>email</th>
		<th>Возраст</th>
		<th>статус</th>
		<th>удалить</th>
		<th>забанить / разбанить</th>
		<th>редактировать</th>
	</tr>
	
	<?php 
	
		foreach(userListForAdmin() as $user) {
			echo '<tr>';
				echo '<td>'.$user['id'].'</td>';
				echo '<td>'.$user['name'].'</td>';
				echo '<td>'.$user['lastname'].'</td>';
				echo '<td>'.$user['email'].'</td>';
				echo '<td>'.$user['age'].'</td>';
				
					if(isAccess([$user['status']]) == 'Юзер') {
						echo '<td>'.isAccess([$user['status']]).' <a href="?status=admin&id='. $user['id'] .'&admin=open">Сделать админом</a></td>';
					}
					else {
						echo '<td>'.isAccess([$user['status']]).'
						<a href="?status=user&id='. $user['id'] .'&admin=open">Сделать юзером</a>
				</td>';
					}
				
				echo '<td><a href="?del-user='.$user['id'].'&admin=open">Удалить</a></td>';
				
				if($user['banned'] == '1') {
					echo '<td><a href="?noneban='.$user['id'].'&admin=open">Разбанить</a></td>';
				}
				else {
					echo '<td>
							<a href="?ban='.$user['id'].'&admin=open">Забанить</a>
							<a href="?ban-hour='.$user['id'].'&admin=open">На час</a>
							<a href="?ban-hour='.$user['id'].'&ban-day=3&admin=open">На 3 дня</a>
						</td>';
				}
				
				echo '<td><a href="?red-user-admin='.$user['id'].'&admin=open">Редактировать</a></td>';
			echo '</tr>';
		}
		
		if(!empty($_GET['ban']) && isAdmin()) {
			userBan($_GET['ban']);
		}
		
		if(!empty($_GET['ban-hour']) && empty($_GET['ban-day'])&& isAdmin()) {
			userBanHour($_GET['ban-hour']);
		}
		
		if(!empty($_GET['ban-hour']) && !empty($_GET['ban-day'])&& isAdmin()) {
			userBanHour($_GET['ban-hour'], $_GET['ban-day']);
		}
		
		if(!empty($_GET['noneban']) && isAdmin()) {
			userNoneBan($_GET['noneban']);
		}
		
		if(!empty($_GET['red-user-admin']) && isAdmin()) {
			require 'edit-user-admin.php';
		}
		
		if(!empty($_GET['status']) && isAdmin()) {
			editUserStatus($_GET['id'], $_GET['status']);
		}
		
		if(!empty($_GET['del-user']) && isAdmin()) {
			delUser($_GET['del-user']);
		}
	?>
</table>


<?php 


/*
echo '<br>';
//http://devacademy.ru/posts/datetime-v-php/
//date_default_timezone_set('UTC');


echo '<br>';
$date = new DateTime(); echo $date->getTimestamp();
echo '<br>';
$hour = $date->getTimestamp() + 3600;
echo $hour;
echo '<br>';
$date = new DateTime($hour, new DateTimeZone('Europe/Moscow'));
echo $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';
$date = new DateTime('', new DateTimeZone('Europe/Moscow'));
$hour = $date->format('H') + 1;
echo $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';
echo $hour;


echo '<br>';
echo '<br>';
$date = new DateTime("now", new DateTimeZone('Europe/Moscow'));
$hour = $date->getTimestamp() + 3600;
$date->setTimestamp($hour);
echo $date->format('Y-m-d H:i:s');

echo '<pre>';
	print_r($date);
echo '</pre>';	

$hour = new DateTime('1 hour', new DateTimeZone('Europe/Moscow'));
echo $hour->format('Y-m-d H:i:s');
*/

/*
	echo '<pre>';
		print_r(userListForAdmin());
	echo '</pre>';	
	*/
	
	/*
$hour1 = new DateTime('2017-12-24 21:36:29', new DateTimeZone('Europe/Moscow'));
$razban1 = $hour1->getTimestamp();	


echo '<br>';
	
$hour2 = new DateTime('now', new DateTimeZone('Europe/Moscow'));
$razban2 = $hour2->getTimestamp();	

echo $razban1 - $razban2;

echo '<br>';

echo ($razban1 - $razban2) < 0;
*/
	

?>

