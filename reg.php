
<h2>Регистрация</h2>

<!-- Это форма регистрации: -->
	<form action='./index.php' method='POST'>
		
		<p><?php echo errorInput('name');?><label>Имя: <input name='name' type="text" value="<?php echo isPost('name');?>"><label></p>
		<p><?php echo errorInput('password');?><label>Пароль: <input name='password' type="text" value="<?php echo isPost('password'); echo isPassword();?>"><label><a href="?pass=gen"> Сгенерировать пароль</a></p>
		<p><?php echo errorInput('famaily');?><label>Фамилия: <input name='famaily' type="text" value="<?php echo isPost('famaily');?>"><label></p>
		<p><?php echo errorInput('age');?><label>Возраст: <input name='age' type="text" value="<?php echo isPost('age');?>"><label></p>
		<p><?php echo errorInput('email');?><label>Email: <input name='email' type="text" value="<?php echo isPost('email');?>"><label></p>
		<p><?php echo errorInput('city');?><label>Город: <input name='city' type="text" value="<?php echo isPost('city');?>"><label></p>
		
		<p><label>Язык: <select name="language">
						
						<?php
							if(!empty($_POST['language'])) {
								echo '<option value="'.isPost('language').'">' . isPost('language') . '</option>';
								
								echo '
									<option value="Русский">Русский</option>
									<option value="Украинский">Украинский</option>
									<option value="Английский">Английский</option></select><label></p>
								';
							}
							
							else {
								?>
							<option value="Русский">Русский</option>
							<option value="Украинский">Украинский</option>
							<option value="Английский">Английский</option>
						</select><label></p>
					
					<?php }?>
		
		
		<input type='submit' name="btn-reg" value='Отправить'>
	</form>
<!-- Конец формы регистрации. -->

<?php 
	if(!empty($_POST['btn-reg'])) {
		if(
		!empty($_POST['password']) &&
		!empty($_POST['name']) &&
		!empty($_POST['famaily']) &&
		!empty($_POST['age']) &&
		!empty($_POST['email']) &&
		!empty($_POST['city']) &&
		!empty($_POST['language'])
		) {
			
			$name = $_POST['name'];
			$password = $_POST['password'];
			$famaily = $_POST['famaily'];
			$age = $_POST['age'];
			$email = $_POST['email'];
			$city = $_POST['city'];
			$language = $_POST['language'];
			
			if(mb_strlen($name) < 4  || mb_strlen($name) > 12) {
				echo 'Логин должен быть от 4 до 12 символов';
				return;
			}
			
			if(mb_strlen($password) < 6  || mb_strlen($password) > 10) {
				echo 'Пароль должен быть от 6 до 10 символов';
				return;
			}
			echo addUser($name, $password, $famaily, $age, $email, $city, $language);
		}
		
		else {
			echo 'Заполните все поля';
		}
	}
	
?>